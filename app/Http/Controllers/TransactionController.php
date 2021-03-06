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


class TransactionController extends Controller 
{
  public function vaciar_cuenta()
  {
    
    $url_neo = config('app.neo_bridge_url').'/wallet/transfer/AJ4GYU9cnaZithFq61fhdLmKsjZgn4dNkG/1d1baeecd50735c4a8379b5ee32a2b53d94a212944a8000a147daf6b0374fcc9/AKhqz1wdB7Yru8QShS6CXVqUF9oDKrZyn4/0.0001800000/GAS';
    $client = new \GuzzleHttp\Client();
    $transfer = $client->get($url_neo)->getBody();
    $transfer = json_decode($transfer);
    dd($transfer);    
    
  }
  public function refund ($id, $amount_refund_poll = null, $mensaje_refun_poll = null)
  {
    $transaction = Transaction::find($id);

    $product = Product::find($transaction->product_id);
    if ($amount_refund_poll!=null) {
      $amount = $amount_refund_poll;
    } else {
      $amount = $transaction->amount;
    }

    $currency = $transaction->currency_name;

    $user = User::find($transaction->user_id);
    $system = Configuration::all()->first();

    $category = \DB::table('productsincategories')->where('product_id', $product->id)->get()->first();

    $client = new \GuzzleHttp\Client();
    $geolocation = $client->get('https://api.ipdata.co/')->getBody();
    $geolocation = json_decode($geolocation);

    
    $url_neo = config('app.neo_bridge_url').'/wallet/transfer/'.$system->wallet_address.'/'.$system->wallet_public_key.'/'.$user->wallet_address.'/'.$amount.'/'.$currency;
    
    $transfer = $client->get($url_neo)->getBody();
    $transfer = json_decode($transfer);
        
    if (!isset($transfer->response->txid)) {
      return response()->json([
          'error' => true,
          'response' => 'Something happened when transferring funds from your wallet, please verify that you have sufficient funds.',
          'request' => $transfer
      ]);
    } else {
      $transaction->refund = 1;
      $transaction->save();

      $transaction = new Transaction;
      $transaction->category_id = $category->id;
      $transaction->product_id = $product->id;
      $transaction->user_id = $user->id;
      $transaction->from = $system->wallet_address;
      $transaction->for = $user->wallet_address;
      $transaction->localization_json = json_encode($geolocation);
      $transaction->currency_name = $currency;
      $transaction->type = 0;
      $transaction->refund = 1;
      $transaction->amount = $amount;
      $transaction->txid = $transfer->response->txid;
      if ($mensaje_refun_poll!=null) {
        $transaction->description = $mensaje_refun_poll;
      } else {
        $transaction->description = 'Transaction for fund reimbursement from the administration, regarding the transaction: '.$id;
      }
      $transaction->contry = $geolocation->country_code;
      $transaction->city = $geolocation->city;
      $transaction->save();

      // Mail::send('emails.admin_refund', ['user' => $user, 'transaction' => $transaction, 'product' => $product], function ($m) use ($user) {
      //     $m->from(config('mail.username'), 'Administration');
      //     $m->to($user->email)->subject('A refund is charged to your account');
      // });

      return response()->json([
          'error' => false,
          'response' => 'This transaction will apply a refund, soon the page is reloaded.',
          'refresh' => true
      ]);
    }
  }

  public function refund_for_client ($id, $amount_refund_poll = null, $mensaje_refun_poll = null)
  {
    $transaction = Transaction::find($id);

    $product = Product::find($transaction->product_id);

    if ($amount_refund_poll!=null) {
      $amount = $amount_refund_poll;
    } else {
      $amount = $transaction->amount;
    }

    $currency = $transaction->currency_name;

    $user = User::find($transaction->user_id);
    $system = Configuration::all()->first();

    $category = \DB::table('productsincategories')->where('product_id', $product->id)->get()->first();

    $client = new \GuzzleHttp\Client();
    $geolocation = $client->get('https://api.ipdata.co/')->getBody();
    $geolocation = json_decode($geolocation);

    
    $url_neo = config('app.neo_bridge_url').'/wallet/transfer/'.$system->wallet_address.'/'.$system->wallet_public_key.'/'.$user->wallet_address.'/'.$amount.'/'.$currency;
    
    $transfer = $client->get($url_neo)->getBody();
    $transfer = json_decode($transfer);
        
    if (!isset($transfer->response->txid)) {
      return response()->json([
          'error' => true,
          'response' => 'Something happened when transferring funds from your wallet, please verify that you have sufficient funds.',
          'request' => $transfer
      ]);
    } else {

      $transaction->refund = 1;
      $transaction->save();
        
      $transaction = new Transaction;
      $transaction->category_id = $category->id;
      $transaction->product_id = $product->id;
      $transaction->user_id = $user->id;
      $transaction->from = $system->wallet_address;
      $transaction->for = $user->wallet_address;
      $transaction->localization_json = json_encode($geolocation);
      $transaction->currency_name = $currency;
      $transaction->type = 0;
      $transaction->refund = 1;
      $transaction->amount = $amount;
      $transaction->txid = $transfer->response->txid;
      if ($mensaje_refun_poll!=null) {
        $transaction->description = $mensaje_refun_poll;
      } else {
        $transaction->description = 'Transaction for fund reimbursement from the administration, regarding the transaction: '.$id;
      }      $transaction->contry = $geolocation->country_code;
      $transaction->city = $geolocation->city;
      $transaction->save();

      // Mail::send('emails.admin_refund', ['user' => $user, 'transaction' => $transaction, 'product' => $product], function ($m) use ($user) {
      //     $m->from(config('mail.username'), 'Administration');
      //     $m->to($user->email)->subject('A refund is charged to your account');
      // });

      return response()->json([
          'error' => false,
          'response' => 'This transaction will apply a refund, soon the page is reloaded.',
          'refresh' => true
      ]);
    }
  }

  public function thanks_for_your_answer($transaction_id, $response) 
  {
    $transaction = Transaction::find($transaction_id);
    if ($transaction) {

      if ($response=='yes') {
        $this->refund_for_client($transaction->id, 0.00005, 'Thank you for answering the survey as a bonus, we will give you a gift!');
        $transaction->poll = 1;
        $transaction->poll_active = 0;
        $transaction->save();
        return redirect('/thanks_for_your_answer');
      }
      
      if ($transaction->user_id == Auth::user()->id && $transaction->refund == 0) {
        if ($response=='not') {
          $this->refund_for_client($transaction->id, 0.00005, 'Thank you for answering the survey as a bonus, we will give you a gift!');
          $transaction->poll = 0;
          $transaction->poll_active = 0;
          $transaction->save();
          return redirect('/cp/users');
        }        
      } 



      return redirect('/');

    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function poll_change_status($transaction_id)
  {
    $transaction = Transaction::find($transaction_id);
    if ($transaction) {
      if ($transaction->poll_active==0) {
        $transaction->poll_active = 1;
      } else {
        $transaction->poll_active = 0;
      }
      $transaction->save();
    }

    return redirect()->back();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>