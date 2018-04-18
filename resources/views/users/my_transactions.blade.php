@extends('users.template')
@section('user_content')
    <div class="top_bar_transactions">
        <div class="row">
            <div class="col-12 col-md-1">
                <img src="{{App\User::auth()->qr}}" style="width: 100%;" alt="">
            </div>
            <div class="col-12 col-md-9">
                <h3>
                    My wallet 
                    <span class="wallet_number">
                        {{App\User::auth()->wallet_address}}
                    </span>
                </h3>
            </div>

            <div class="col-6 col-md-2 text-center">
                <h5>
                    {{number_format(App\User::auth()->balance->GAS->balance, 10, ',', '.')}}
                    <span style="font-size: 14px; margin-top: 5px; display: block; opacity: .7;">
                        SBB - Token
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
            <button class="btn-sb openwalletqr">
                Add funds to my wallet
            </button>

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
            $pollspending = App\Transaction::where('user_id', \Auth::user()->id)->where('poll_active', 1)->where('poll', null)->count();
            @endphp
            @if($pollspending>=1)
                <div class="alert alert-info text-info">
                    You have <strong><u>{{ $pollspending }}</u></strong> quantity of products, with active survey and without responding! Help us improve by responding to surveys.
                </div>
            @endif

            @php
                $transactions = App\Transaction::where('user_id', \Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);
            @endphp
            @foreach($transactions as $transaction)
                <div class="row">
                    <div class="col-md-12 my_transactions">
                        @php
                            if($transaction->type==1) {
                                $type='in';
                            } else {
                                $type='out';
                            }
                        @endphp

                        <div class="transaction {{$type}}">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="amount">
                                        {{number_format($transaction->amount, 10, ',', '.')}} SBB - Token
                                    </div>
                                    <div class="description">
                                        {{$transaction->description}}
                                        <span style="display: block;">
                                            <b>TXID:</b> {{$transaction->txid}} 
                                            @if($transaction->type!=3)
                                                <b>Product:</b> {{App\Product::find($transaction->product_id)->title}}
                                            @endif
                                            <b>Transaction ID:</b> {{$transaction->id}}
                                        </span>
                                        <strong>Date:</strong> {{$transaction->created_at->format('y-m-d h:i:s')}}
                                    </div>
                                </div>
                            </div>

                            @if($transaction->refund==0 && $transaction->type!=3)
                            <hr>
                            <div class="row" style="margin-bottom: -10px;">
                                <div class="col-md-12">
                                    <label style="display: block;margin-bottom: -8px;">
                                        <u>
                                            Available options for transactions: 
                                        </u>
                                    </label>
                                    
                                    @if($transaction->refund==0)
                                        <button class="btn btn-link make_refund" style="color: #000; padding: 5px 0; font-weight: 500;" @click='refund("{{url('/cp/users/transactions/'.$transaction->id.'/refund')}}")'>
                                            Make a refund
                                        </button>
                                    @endif

                                </div>
                            </div>
                            @endif
                            
                            @if($transaction->poll_active == 1)
                            <p>
                                <br>
                                <strong>Answer the following survey</strong>
                                <br>
                                Did you like our product?
                                <br>
                                <a href="{{url('/thanks_for_your_answer/'.$transaction->id.'/yes')}}">YES</a> <a href="{{url('/thanks_for_your_answer/'.$transaction->id.'/not')}}">NOT</a>
                            </p>
                            @endif

                        </div>


                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-md-12 ppp">
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
                                console.log(response);
                                $('.errortrue').remove();
                                
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