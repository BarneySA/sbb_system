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

class CategoryController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('categories.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function change_status($Category_id)
  {
    $Category = Category::find($Category_id);
    if ($Category) {
      if ($Category->status==0) {
        $Category->status = 1;
      } else {
        $Category->status = 0;
      }
      $Category->save();
    }

    return redirect()->back();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
    $category = new Category;
    $category->name = $request->input('name');
    $category->slug = str_slug($request->input('name'));
    $category->parent = '-1';
    $category->status = 1;
    $category->save();

    return redirect()->back();
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
    Category::find($id)->delete();
    return redirect()->back();
  }
  
}

?>