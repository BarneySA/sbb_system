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

class ProductController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
  }

  public function categories()
  {
    $categories = Category::where('status', 1)->get();
    return view('products.categories', ['categories' => $categories]);
  }

  public function category($slug)
  {
    $category = Category::where('slug', $slug)->get();

    $products = collect();
    if (count($category)==1) {
      foreach (\DB::table('productsincategories')->where('category_id', $category[0]->id)->get() as $product_id) {
       $product = Product::find($product_id->product_id);
       if ($product) {
         if ($product->status==1) {
           $products->push($product);
         }
       } 
      }
    }
    return view('products.category', ['category' => $category, 'products' => $products]);
  }

  public function product ($slug) 
  {
    $product = Product::where('slug', $slug)->get();
    return view('products.product', ['product' => $product]);
  }
  
  public function register_transaction(Request $request)
  {
    $product = Product::find($request->input('product_id'));
    $amount = $request->input('amount');
    $currency = $request->input('currency');

    $user = Auth::user();
    $system = Configuration::all()->first();

    $category = \DB::table('productsincategories')->where('product_id', $product->id)->get()->first();

    $client = new \GuzzleHttp\Client();
    $geolocation = $client->get('https://api.ipdata.co/')->getBody();
    $geolocation = json_decode($geolocation);

    $url_neo = config('app.neo_bridge_url').'/wallet/transfer/'.$user->wallet_address.'/'.$user->wallet_public_key.'/'.$system->wallet_address.'/'.$amount.'/'.$currency;

    $transfer = $client->get($url_neo)->getBody();
    $transfer = json_decode($transfer);

    if (!isset($transfer->response)) {
      return response()->json([
          'error' => true,
          'response' => 'Something happened when transferring funds from your wallet, please verify that you have sufficient funds.',
          'request' => $transfer
      ]);
    } else {
      $transaction = new Transaction;
      $transaction->category_id = $category->id;
      $transaction->product_id = $product->id;
      $transaction->user_id = Auth::user()->id;
      $transaction->from = $user->wallet_address;
      $transaction->for = $system->wallet_address;
      $transaction->localization_json = json_encode($geolocation);
      $transaction->currency_name = $currency;
      $transaction->type = 1;
      $transaction->amount = $amount;
      $transaction->txid = $transfer->response->txid;
      $transaction->description = 'Transaction made for the purchase of the product "('.$product->id.') '.$product->title.'"';
      $transaction->contry = $geolocation->country_code;
      $transaction->city = $geolocation->city;
      $transaction->save();
  
      Mail::send('emails.product_purchase', ['user' => $user, 'transaction' => $transaction, 'product' => $product], function ($m) use ($user) {
          $m->from(config('mail.username'), 'Administration');
          $m->to($user->email)->subject('Thanks for your purchase!');
      });

      return response()->json([
          'error' => false,
          'response' => 'Purchase made successfully! we will send you an email with the information of the transaction.',
          'request' => $transfer
      ]);
    }

  }

}

?>