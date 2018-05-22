<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Validator;
use Auth;
use Mail;

use Carbon\Carbon;

use App\Attribue;
use App\Category;
use App\Configuration;
use App\Feedback;
use App\Product;
use App\SecurityToken;
use App\Tracking;
use App\Transaction;
use App\User;

class UserController extends Controller 
{

  public function index ()
  {       
      return redirect('/cp/users/my_transactions');
      return view('my_account');
  }

  public function my_transactions ()
  {       
      return view('users.my_transactions');
  }

  public function my_shopping ()
  {       
      return view('users.my_purchased_products');
  }

  public function admin_transactions() 
  {
    return view('users.admin.transactions');
  }

  public function admin_users ()
  {       
      return view('users.admin.users.index');
  }

  public function register (Request $request)
  {       
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email|max:60',
            'password' => 'required|max:24',
            'birthdate' => 'required|max:12',
            'city' => 'required|max:30',
            'name' => 'required|max:26',
            'gender' => 'required|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'input' => true,
                'response' => $validator->errors()
            ]);
        } else {

            $client = new \GuzzleHttp\Client();
            $url_neo = config('app.neo_bridge_url').'/wallet/create';
            $wallet = $client->get($url_neo)->getBody();
            $wallet = json_decode($wallet);

            $address = $wallet->_address;
            $publickey = $wallet->_privateKey;

            $geolocation = $client->get('https://api.ipdata.co/')->getBody();
            $geolocation = json_decode($geolocation);

            $user = new User;
            $user->name = $request->input('name');
            $user->username = $request->input('name');
            $user->password = \Hash::make($request->input('password'));
            $user->birthdate = $request->input('birthdate');
            $user->contry = $geolocation->country_code;
            $user->email = $request->input('email');
            $user->city = $geolocation->city;
            $user->wallet_public_key = $publickey;
            $user->wallet_address = $address;
            $user->role = 0;
            $user->status = 1;
            $user->save();

            Auth::loginUsingId($user->id, true);

            return response()->json([
                'error' => false,
                'response' => 'Thank you for validating your login, you will be redirected to your account!',
                'redirect' => url('/cp/users/my_transactions')
            ]);
        }
  }

  public function change_status_acc ($id)
  {       
      $user = User::find($id);
      if ($user->status == 1) {
            $user->status = 0;
        } else {
            $user->status = 1;
      }
      $user->save();
      return redirect()->back();
  }

  public function send_currency ($currency, $user_id) 
  {
    $user = User::auth($user_id);
    return view('users.admin.users.send_currency', ['user' => $user] );        
  }

  public function send_currency_post ($currency, $user_id, Request $request) 
  {
    $user = User::find($user_id);
    $configuration = Configuration::g();
    $amount = $request->input('amount');

    if ($currency == 'NEO' && $configuration->balance->NEO->balance < $amount) {
        $request->session()->flash('status', 'Your balance does not have enough funds to process this transaction, please check the balance of the master wallet. The maximum you can send is: NEO '.$configuration->balance->NEO->balance);
        return redirect()->back();
    } elseif ($currency == 'GAS' && $configuration->balance->GAS->balance < $amount) { 
        $request->session()->flash('status', 'Your balance does not have enough funds to process this transaction, please check the balance of the master wallet. The maximum you can send is: GAS '.$configuration->balance->GAS->balance);
        return redirect()->back();
    } else {
        
        $amount = str_replace(',', '.', $amount);

        $url_neo = config('app.neo_bridge_url').'/wallet/transfer/'.$configuration->wallet_address.'/'.$configuration->wallet_public_key.'/'.$user->wallet_address.'/'.$amount.'/'.$currency;
        
        $client = new \GuzzleHttp\Client();
        $geolocation = $client->get('https://api.ipdata.co/')->getBody();
        $geolocation = json_decode($geolocation);

        $transfer = $client->get($url_neo)->getBody();
        $transfer = json_decode($transfer);

        if ($transfer->response->result==false) {
            $request->session()->flash('status', 'There was a problem transferring funds, please check and try again in a few minutes.');
        } else {
            $transaction = new Transaction;
            $transaction->category_id = '-1';
            $transaction->product_id = '-1';
            $transaction->user_id = $user->id;
            $transaction->from = $configuration->wallet_address;
            $transaction->for = $user->wallet_address;
            $transaction->localization_json = json_encode($geolocation);
            $transaction->currency_name = $currency;
            $transaction->type = 3;
            $transaction->refund = 0;
            $transaction->amount = $amount;
            $transaction->txid = $transfer->response->txid;
            $transaction->description = 'An administrator execute a transfer of funds to the user: ['.$user->id.'] '.$user->name.' ';
            $transaction->contry = $geolocation->country_code;
            $transaction->city = $geolocation->city;
            $transaction->save();
    
            $request->session()->flash( 'success', 'Successful tide funds were sent. You can see the transaction information in the transaction module.');
            
        }

        return redirect()->back();

    }
    
  }

  public function send_reward_user ($user_id, Request $request) 
  {
    $user = User::find($user_id);
    $configuration = Configuration::g();
    $amount = 0.00005;

    if ($configuration->balance->GAS->balance < $amount) { 
        $request->session()->flash('status', 'Your balance does not have enough funds to process this transaction, please check the balance of the master wallet. The maximum you can send is: SBB - Token '.$configuration->balance->GAS->balance);
        return redirect()->back();
    } else {
        $url_neo = config('app.neo_bridge_url').'/wallet/transfer/'.$configuration->wallet_address.'/'.$configuration->wallet_public_key.'/'.$user->wallet_address.'/'.$amount.'/GAS';
        
        $client = new \GuzzleHttp\Client();
        $geolocation = $client->get('https://api.ipdata.co/')->getBody();
        $geolocation = json_decode($geolocation);

        $transfer = $client->get($url_neo)->getBody();
        $transfer = json_decode($transfer);

        if ($transfer->response->result==false) {
            $request->session()->flash('status', 'There was a problem transferring funds, please check and try again in a few minutes.');
        } else {
            $transaction = new Transaction;
            $transaction->category_id = '-1';
            $transaction->product_id = '-1';
            $transaction->user_id = $user->id;
            $transaction->from = $configuration->wallet_address;
            $transaction->for = $user->wallet_address;
            $transaction->localization_json = json_encode($geolocation);
            $transaction->currency_name = 'GAS';
            $transaction->type = 3;
            $transaction->refund = 0;
            $transaction->amount = $amount;
            $transaction->txid = $transfer->response->txid;
            $transaction->description = 'The administrator sent you a gift for '.number_format($amount, 10, ',', '.').' SBB - Token ['.$user->id.'] '.$user->name.' ';
            $transaction->contry = $geolocation->country_code;
            $transaction->city = $geolocation->city;
            $transaction->save();
    
            $request->session()->flash( 'success', 'Successful tide funds were sent. You can see the transaction information in the transaction module.');
            return redirect()->back();
        }
        
        $request->session()->flash('status', 'There was a problem transferring funds, please check and try again in a few minutes.');
        return redirect()->back();

    }
    
  }
  
}

?>