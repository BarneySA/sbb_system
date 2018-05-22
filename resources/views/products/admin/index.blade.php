@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="title">
            <h1>Products
            </h1>
            <p>
                List of system products
            </p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">

    <div class="row">
        <div class="col-md-12">
            <a href="{{url('/cp/admin/products/create')}}" class="btn btn-primary">
                Create new product
            </a>

            <hr>
        </div>
    </div>

    <div class="row mt-3 transactions_list">
        <div class="col-md-12">

            <table class="table_dt table table-hover table-striped table-bordered" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Opt</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Transactions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Product::all() as $product)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 10px;">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        @if(\App\Transaction::where('product_id', $product->id)->count() == 0 && $product->id!=1)
                                            <li>
                                                <a class="dropdown-item" href="{{url('/cp/admin/products/destroy/'.$product->id)}}">Remove</a>
                                            </li>
                                        @endif
                                            
                                        @if($product->status == 0)
                                            <li>
                                                <a class="dropdown-item" href="{{url('/cp/admin/products/change_status_p/'.$product->id)}}">Enable</a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item" href="{{url('/cp/admin/products/change_status_p/'.$product->id)}}">Disabled</a>
                                            </li>
                                        @endif

                                            <li>
                                                <a class="dropdown-item" href="{{url('/cp/admin/products/edit/'.$product->id)}}">Edit</a>
                                            </li>
                                        
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $product->id }}
                            </td>
                            <td>
                                {{ $product->title }}
                                @if($product->id==1)
                                 <br>
                                    <b> 
                                        Product with  
                                        <u>
                                            smart contract
                                        </u>
                                    </b>
                                @endif
                            </td>
                            
                            <td>
                                @if($product->status == 0)
                                    <div class="label label-danger">
                                        Inactive
                                    </div>
                                @else
                                    <div class="label label-success">
                                        Active
                                    </div>
                                @endif
                            </td>
                            <td>
                                {{ number_format($product->amount, 10, ',', '.') }}
                                SBB - Token 
                                @php
                                    $client = new \GuzzleHttp\Client();
                                    $gas_amount = $client->get('https://api.coinmarketcap.com/v1/ticker/gas/?convert=CHF')->getBody();
                                    $gas_amount = json_decode($gas_amount);
                                        
                                    $balance = $product->amount * $gas_amount[0]->price_chf;
                                @endphp
                                <br>
                                {{number_format($balance, 10, ',', '.')}} CHF 
                            </td>
                            <td>
                                {{ \App\Transaction::where('product_id', $product->id)->count() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    </div>

@endsection