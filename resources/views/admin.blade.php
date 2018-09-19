@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="icon icon-lg">
            <span class="icon-home"></span>
        </div>
        <div class="title">
            <h1>Home</h1>
            <p>Welcome</p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">

        @if(!isset($transactions))
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>
                                Clients
                            </label>
                            <select name="clients[]" class="form-control" multiple>
                                <option value="*" selected>All</option>
                                @foreach(App\User::where('role', 0)->get() as $client)
                                    <option value="{{$client->id}}">
                                        {{$client->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>
                                Cities
                            </label>

                            @php
                                $cities = collect();
                                
                                foreach(App\Transaction::where('refund', 0)->get() as $transaction) {
                                    $cities->push($transaction->city);
                                }

                                $cities = $cities->unique();                      
                            @endphp

                            <select name="cities[]" class="form-control" multiple>
                                <option value="*" selected>All</option>
                                @foreach($cities as $city)
                                    <option value="{{$city}}">
                                        {{$city}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>
                                Products
                            </label>
                            <select name="products[]" class="form-control" multiple>
                                <option value="*" selected>All</option>
                                @foreach(App\Product::all() as $product)
                                    <option value="{{$product->id}}">
                                        {{$product->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <button type="submit" class="btn btn-success">Get results</button>
                    </div>
                </div>
            </form>
        @endif

        @if(isset($transactions))
        <div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">                                    
                        <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">                                                                                    
                            <div class="line">
                                <div class="title">Sales</div>
                            </div>
                            <div class="intval intval-lg">
                                {{count($transactions)}}
                            </div>
                            <div class="line">
                                <div class="subtitle">Total sales</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">                                    
                        <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">                                                                                    
                            <div class="line">
                                <div class="title">Gains</div>
                            </div>
                            <div class="intval intval-lg">
                                {{number_format($totals->in*100000, 3, ',', '.')}}
                            </div>
                            <div class="line">
                                <div class="subtitle">Gains in SBB - Token</div>
                            </div>
                        </div>
                    </div>

                </div>

                <br>
                <table class="table_dt table table-hover table-striped table-bordered" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                {{ $transaction->id }}
                            </td>
                            <td>
                                {{ $transaction->created_at }}
                            </td>
                            <td>
                                @if($transaction->type!=3)
                                    {{App\Product::find($transaction->product_id)->title}}
                                @else
                                ---
                                @endif
                            <td>
                                @if($transaction->user_id!=-1)
                                    {{ App\User::find($transaction->user_id)->name }}
                                @else
                                    ---
                                @endif
                            </td>
                            <td>
                                {{number_format($transaction->amount*100000, 3, ',', '.')}} SBB - Token
                            </td>
                            <td>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#myModal_{{ $transaction->id }}">
                                Open information
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal_{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <p style="font-weight: bold;">Description: </p>
                                        <p>
                                            {{$transaction->description}}
                                        </p>
                                        
                                        <br>
                                        <img src="{{url('/images/neotracker.png')}}" style="height: 35px;" alt="">
                                        <p style="font-weight: bold;">TXID: </p>
                                        <p>
                                            <a href="https://neotracker.io/tx/{{$transaction->txid}}" target="tx">
                                                 {{$transaction->txid}} 
                                            </a>
                                        </p>
                                        
                                        <p style="display: block;">
                                            @if($transaction->type!=3)
                                                @if($transaction->refund==1)
                                                    <span class="text-warning">
                                                        This transaction was reimbursed.
                                                    </span>
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                    </div>
                                </div>
                                </div>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{url('/cp/admin')}}" class="btn btn-danger">
                    Back
                </a>
            </div>
        </div>
        @endif
        
    </div>
    <!-- END PAGE CONTAINER -->

@endsection