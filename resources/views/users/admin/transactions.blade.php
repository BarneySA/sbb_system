@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="title">
            <h1>My last transactions</h1>
            <p>
                Here we present your last transactions, you can see fund income as well as expenses made in your account.
            </p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">

    <div class="top_bar_transactions">
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <!-- HEADING -->
                    <div class="app-heading app-heading-small">                                        
                        <div class="title">
                            <h2>System wallet</h2>
                            <p>{{App\Configuration::g()->wallet_address}}</p>
                        </div>                 
                    </div>
                    <!-- END HEADING -->
                    
                    
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <img src="{{App\Configuration::g()->qr}}" style="width: 100%;" alt="">
                        </div>
                        <div class="col-6 col-md-10 text-left">
                            <h5 style="margin-top: 2px;">
                                {{number_format(App\Configuration::g()->balance->GAS->balance, 10, ',', '.')}}
                                <span style="font-size: 14px; margin-top: 0px; display: block; opacity: .7;">
                                    SBB - Token
                                    <span style="display: block; margin-top: 0">
                                        Balance
                                    </span>
                                </span>
                            </h5>
    
                        </div>
    
                    </div>
                </div>

            </div>
        </div>


    </div>

    <div class="row mt-3 transactions_list">
        <div class="col-md-12">

            <div class="errors__"></div>
            <div class="row" v-if="loading==1">
                <div class="col-md-12">
                <div class="alert alert-info ">
                    Loading...
                </div>
                </div>
            </div>

            @php
                $transactions = App\Transaction::orderBy('created_at', 'DESC')->get();
            @endphp

            <table class="table_dt table table-hover table-striped table-bordered" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Opt</th>
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
                        <div class="dropdown">
                            <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 10px;">
                                Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            
                                @if($transaction->refund==0 && $transaction->type!=3)
                                <li>
                                    <a class="dropdown-item make_refund" style="cursor:pointer;" @click='refund("{{url('/cp/admin/transactions/'.$transaction->id.'/refund')}}")'>
                                        Make a refund
                                    </a>
                                </li>
                                @else

                                @endif

                                @if($transaction->poll==null && $transaction->refund==0 && $transaction->type!=3) 
                                    @if($transaction->poll_active==0)
                                        <li>
                                            <a class="dropdown-item" href="{{url('/cp/admin/transactions/'.$transaction->id.'/poll_change_status')}}">Enable survey</a>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{url('/cp/admin/transactions/'.$transaction->id.'/poll_change_status')}}">Disable survey</a>
                                        </li>
                                    @endif
                                @endif

                                <li>
                                    <a class="dropdown-item" href="{{url('/cp/admin/send/GAS/'.$transaction->user_id)}}">Send funds to this user</a>
                                </li>

                            </div>
                        </div>
                        </td>
                        <td>
                            {{ $transaction->id }}
                        </td>
                        <td>
                            {{ $transaction->created_at->format('Y-m-d H:i:s') }}
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
                            {{number_format($transaction->amount, 10, ',', '.')}} SBB - Token
                            @php
                                $client = new \GuzzleHttp\Client();
                                $gas_amount = $client->get('https://api.coinmarketcap.com/v1/ticker/gas/?convert=CHF')->getBody();
                                $gas_amount = json_decode($gas_amount);
                                    
                                $balance = $transaction->amount * $gas_amount[0]->price_chf;
                            @endphp
                            <br>
                            {{number_format($balance, 10, ',', '.')}} CHF 
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

            @if(count($transactions)==0)
            <div class="row">
                <div class="col-md-12">
                <div class="alert alert-danger ">
                    We do not find results.
                </div>
                </div>
            </div>
            @endif

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
    <script>

        $(document).ready(function(){
            const app = new Vue({
                el: '.transactions_list',
                data: function () {
                    var url = $('meta[name="site_url"]').attr('content');
                    return {
                        url: url,
                        loading: 0
                    }
                },
                
                methods: {
                    refund: function (url) {
                        vm = this;
                        vm.loading = 1;
                        $('.errortrue').remove();
                        
                        $.ajax({
                            type: "post",
                            url: url,
                            data: {},
                            dataType: "json",
                            success: function (response) {
                                vm.loading = 0;
                                console.log(response);

                                if (response.error==true) {
                                    $('.errortrue').remove();
                                    $('.errors__').after(`
                                        <div class="alert alert-danger  errortrue" style="margin-top: 10px;">
                                            ${response.response}
                                        </div>    
                                    `); 
                                } else {
                                    $('.errortrue').remove();
                                    $('.errors__').after(`
                                        <div class="alert alert-success  errortrue" style="margin-top: 10px;">
                                            ${response.response}
                                        </div>    
                                    `); 
                                }
                                
                                if (response.refresh) {
                                    if (response.refresh==true) {
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1500);
                                    }
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>

    </div>

@endsection