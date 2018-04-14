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