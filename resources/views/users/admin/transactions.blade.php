@extends('users.template')
@section('user_content')
    <div class="top_bar_transactions">
        <div class="row">
            <div class="col-12 col-md-1">
                <img src="{{App\Configuration::g()->qr}}" style="width: 100%;" alt="">
            </div>
            <div class="col-12 col-md-7">
                <h3>
                    System wallet
                    <span class="wallet_number">
                        {{App\Configuration::g()->wallet_address}}
                    </span>
                </h3>
            </div>
            <div class="col-6 col-md-2 text-center">
                <h5>
                    {{number_format(App\Configuration::g()->balance->NEO->balance, 10, ',', '.')}}
                    <span style="font-size: 14px; margin-top: 5px; display: block; opacity: .7;">
                        NEO
                        <span style="display: block; margin-top: 0">
                            Balance
                        </span>
                    </span>
                </h5>

            </div>
            <div class="col-6 col-md-2 text-center">
                <h5>
                    {{number_format(App\Configuration::g()->balance->GAS->balance, 10, ',', '.')}}
                    <span style="font-size: 14px; margin-top: 5px; display: block; opacity: .7;">
                        GAS
                        <span style="display: block; margin-top: 0">
                            Balance
                        </span>
                    </span>
                </h5>

            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <a href="" class="btn-sb">
                Download transaction history
            </a>
        </div>
    </div>
    <div class="row mt-3 transactions_list">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <h3>
                        My last transactions
                    </h3>
                    <p class="text-muted">
                        Here we present your last transactions, you can see fund income as well as expenses made in your account.
                    </p>
                </div>
            </div>

            <div class="errors__"></div>
            <div class="row" v-if="loading==1">
                <div class="col-md-12">
                <div class="alert alert-info text-info">
                    Loading...
                </div>
                </div>
            </div>

            @php
                $transactions = App\Transaction::where('user_id', \Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
            @endphp
            @foreach($transactions as $transaction)
                <div class="row">
                    <div class="col-md-12 my_transactions">

                        @php
                            if($transaction->type==1) {
                                $type='out';
                            } else {
                                $type='in';
                            }
                        @endphp
                        <div class="transaction {{$type}}">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="y">
                                        {{$transaction->created_at->format('Y')}}
                                    </div>
                                    <div class="dd">
                                        {{$transaction->created_at->format('m/d')}}
                                    </div>
                                    <div>
                                        <b>ID:</b> {{$transaction->id}}
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="amount">
                                        {{number_format($transaction->amount, 10, ',', '.')}} {{$transaction->currency_name}}
                                    </div>
                                    <div class="description">
                                        {{$transaction->description}}
                                        <span style="display: block;">
                                            <b>TXID:</b> {{$transaction->txid}} 
                                            <b>Product:</b> {{App\Product::find($transaction->product_id)->title}}
                                            @if($transaction->refund==1)
                                                <p>
                                                <span class="text-info">
                                                    This transaction was reimbursed.
                                                </span>
                                                </p>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if($transaction->refund==0)
                            <hr>
                            <div class="row" style="margin-bottom: -10px;">
                                <div class="col-md-12">
                                    <label style="display: block;margin-bottom: -8px;">
                                        <u>
                                            Available options for transactions: 
                                        </u>
                                    </label>
                                    
                                    @if($transaction->refund==0)
                                        <button class="btn btn-link make_refund" style="color: #000; padding: 5px 0; font-weight: 500;" @click='refund("{{url('/cp/admin/transactions/'.$transaction->id.'/refund')}}")'>
                                            Make a refund
                                        </button>
                                        /
                                    @endif

                                    @if($transaction->refund==0)
                                        <a href="#" class="btn btn-link" style="color: #000; padding: 5px 0; font-weight: 500;">
                                            Request service feedback
                                        </a>
                                    @endif

                                </div>
                            </div>
                            @endif
                        </div>


                    </div>

                </div>
            @endforeach

            <div class="row">
                <div class="col-md-12">
                    {{ $transactions->links() }}
                </div>
            </div>

            @if(count($transactions)==0)
            <div class="row">
                <div class="col-md-12">
                <div class="alert alert-danger text-danger">
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
                                        <div class="alert alert-danger text-danger errortrue" style="margin-top: 10px;">
                                            ${response.response}
                                        </div>    
                                    `); 
                                } else {
                                    $('.errortrue').remove();
                                    $('.errors__').after(`
                                        <div class="alert alert-success text-success errortrue" style="margin-top: 10px;">
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



@endsection