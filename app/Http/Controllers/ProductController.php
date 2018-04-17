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
    return view('products.admin.index');
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

    if (!isset($transfer->response->txid)) {
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

      // Mail::send('emails.product_purchase', ['user' => $user, 'transaction' => $transaction, 'product' => $product], function ($m) use ($user) {
      //     $m->from(config('mail.username'), 'Administration');
      //     $m->to($user->email)->subject('Thanks for your purchase!');
      // });



      return response()->json([
          'error' => false,
          'response' => 'Purchase made successfully! we will send you an email with the information of the transaction.',
          'request' => $transfer
      ]);
    }

  }

  public function change_status_p($Product_id)
  {
    $Product = Product::find($Product_id);
    if ($Product) {
      if ($Product->status==0) {
        $Product->status = 1;
      } else {
        $Product->status = 0;
      }
      $Product->save();
    }
    return redirect()->back();
  }

  public function create()
  {
    return view('products.admin.create');
  }

  public function edit($product_id)
  {
    $product = Product::find($product_id);
    return view('products.admin.edit', [
      'product' => $product
    ]);
  }

  public function update(Request $request, $product_id)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:products,title,'.$product_id.'|max:80',
        'amount' => 'required|max:12',
        'description' => 'required|max:1200',
        'billboard' => 'image|mimes:jpg,png,gif,jpeg|max:3048'
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    } else {

      if ($request->file('billboard')!=null) {
        $image = $request->file('billboard');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/products');
        $image->move($destinationPath, $input['imagename']);
      }

      $product = Product::find($product_id);
      $product->title = $request->input('name');
      $product->slug = str_slug($request->input('name'));
      $product->description = $request->input('description');

      if ($request->file('billboard')!=null) {
        $product->billboard = $input['imagename'];
      }

      $product->amount = $request->input('amount');
      $product->currency = 'GAS';
      $product->save();

      \DB::table('productsincategories')->insert([
          'product_id'=>$product->id,
          'category_id'=>$request->input('category_id')
      ]);

      return back()->with('success','The product was update successfully');
    }
  }

  public function destroy($product_id)
  {
    Product::find($product_id)->delete();
    return redirect()->back();
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:products,title|max:80',
        'amount' => 'required|max:12',
        'description' => 'required|max:1200',
        'billboard' => 'required|image|mimes:jpg,png,gif,jpeg|max:3048'
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    } else {

      $image = $request->file('billboard');
      $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/images/products');
      $image->move($destinationPath, $input['imagename']);

      $product = new Product;
      $product->title = $request->input('name');
      $product->slug = str_slug($request->input('name'));
      $product->description = $request->input('description');
      $product->billboard = $input['imagename'];
      $product->amount = $request->input('amount');
      $product->currency = 'GAS';
      $product->save();

      \DB::table('productsincategories')->insert([
          'product_id'=>$product->id,
          'category_id'=>$request->input('category_id')
      ]);

      return back()->with('success','The product was created successfully');
    }
  }

}

?>