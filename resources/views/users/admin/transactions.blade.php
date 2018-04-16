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
                                    GAS
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
                        <th>Client</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($transactions as $transaction)
                    <tr>
                        <td>
                            @if($transaction->refund==0 && $transaction->type!=3)
                            <div class="dropdown">
                                <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 10px;">
                                    Actions
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <li>
                                        <a class="dropdown-item make_refund" @click='refund("{{url('/cp/admin/transactions/'.$transaction->id.'/refund')}}")'>
                                            Make a refund
                                        </a>
                                    </li>

                                    
                                </div>
                            </div>
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            {{ $transaction->id }}
                        </td>
                        <td>
                            {{ $transaction->created_at->format('Y-m-d H:i:s') }}
                        </td>
                        <td>
                            @if($transaction->user_id!=-1)
                                {{ App\User::find($transaction->user_id)->name }}
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            {{number_format($transaction->amount, 10, ',', '.')}} {{$transaction->currency_name}}
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
                                    
                                    <p style="font-weight: bold;">TXID: </p>
                                    <p>
                                        {{$transaction->txid}} 
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
                        
                        $.ajax({
                            type: "post",
                            url: url,
                            data: {},
                            dataType: "json",
                            success: function (response) {
                                vm.loading = 0;

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