@extends('users.template')
@section('user_content')
    <div class="top_bar_transactions">
        <div class="row">
            <div class="col-12 col-md-1">
                <img src="{{App\User::auth()->qr}}" style="width: 100%;" alt="">
            </div>
            <div class="col-12 col-md-7">
                <h3>
                    My wallet 
                    <span class="wallet_number">
                        {{App\User::auth()->wallet_address}}
                    </span>
                </h3>
            </div>
            <div class="col-6 col-md-2 text-center">
                <h5>
                    {{number_format(App\User::auth()->balance->NEO->balance, 10, ',', '.')}}
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
                    {{number_format(App\User::auth()->balance->GAS->balance, 10, ',', '.')}}
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
            <button class="btn-sb openwalletqr">
                Add funds to my wallet
            </button>


            <a href="" class="btn-link" style="color: #000">
                Download transaction history
            </a>
        </div>
    </div>
    <div class="row mt-3">
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


            @php
                $transactions = App\Transaction::where('user_id', \Auth::user()->id)->paginate(10);
            @endphp
            @foreach($transactions as $transaction)
                <div class="row">
                    <div class="col-md-12 my_transactions">

                        <div class="transaction in">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="y">
                                        {{$transaction->created_at->format('Y')}}
                                    </div>
                                    <div class="dd">
                                        {{$transaction->created_at->format('m/d')}}
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
                                            <b>Transaction ID:</b> {{$transaction->id}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-md-12">
                    {{ $transactions->links() }}
                </div>
            </div>



        </div>
    </div>

@endsection