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


class HomeController extends Controller 
{
    public function index () {
        return view('admin');
    }

    public function filtering_and_reports(Request $request) 
    {
        $clients = $request->input('clients');
        if (in_array('*', $clients)) {
            $clients = ['*'];
        } else {
            $clients = $clients;
        }

        $products = $request->input('products');
        if (in_array('*', $products)) {
            $products = ['*'];
        } else {
            $products = $products;
        }

        $cities = $request->input('cities');
        if (in_array('*', $cities)) {
            $cities = ['*'];
        } else {
            $cities = $cities;
        }

        $query_cities = '';
        if ($cities[0]!='*') {
            $query_cities = ' and city in (';
            foreach ($cities as $city) {
                $query_cities .= '"'.$city.'",';
            }
            $query_cities .= ')';
            $query_cities = str_replace('",)', '")', $query_cities);
        }

        $query_products = '';
        if ($products[0]!='*') {
            $query_products = ' and product_id in (';
            foreach ($products as $product_id) {
                $query_products .= '"'.$product_id.'",';
            }
            $query_products .= ')';
            $query_products = str_replace('",)', '")', $query_products);
        }

        $query_clients = '';
        if ($clients[0]!='*') {
            $query_clients = ' and user_id in (';
            foreach ($clients as $user_id) {
                $query_clients .= '"'.$user_id.'",';
            }
            $query_clients .= ')';
            $query_clients = str_replace('",)', '")', $query_clients);
        }

        $query = 'select * from transactions where id > 0 and refund = 0 and type != 3';
        $query.= $query_cities;
        $query.= $query_products;
        $query.= $query_clients;

        $response = \DB::select($query);
        
        $transactions = collect();
        $transactions->in = 0;
        $transactions->out = 0;
        
        foreach($response as $transaction) {
            if ($transaction->type == 1) {
                $transactions->in += $transaction->amount;
            }

            if ($transaction->type == 0) {
                $transactions->out += $transaction->amount;
            }
        }
        
        
        return view('admin', ['transactions' => $response, 'totals' => $transactions]);


    }
  
}

?>