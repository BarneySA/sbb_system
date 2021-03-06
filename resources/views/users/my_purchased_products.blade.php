@extends('users.template')
@section('user_content')

    <div class="row mt-3 transactions_list">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <h3>
                        My latest products purchased
                    </h3>
                    <p class="text-muted">
                        List of products purchased
                    </p>
                </div>
            </div>

            @php
                $transactions = App\Transaction::where('user_id', \Auth::user()->id)->where('type', '!=','3')->where('refund', '0')->orderBy('created_at', 'DESC')->paginate(5);
            @endphp

            @foreach($transactions as $transaction)
                <div class="row">
                    <div class="col-md-12 my_transactions">
                        <div class="transaction">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="amount">
                                        @if($transaction->type!=3)
                                        {{ App\Product::find($transaction->product_id)->title }}
                                        @endif
                                        <br>
                                        <small> 
                                            <strong>
                                                {{number_format($transaction->amount*100000, 3, ',', '.')}} SBB - Token  /
                                                @php
                                                    $client = new \GuzzleHttp\Client();
                                                    $gas_amount = $client->get('https://api.coinmarketcap.com/v1/ticker/gas/?convert=CHF')->getBody();
                                                    $gas_amount = json_decode($gas_amount);
                                                        
                                                    $balance = $transaction->amount * $gas_amount[0]->price_chf;
                                                @endphp
                                                <br>
                                                {{number_format($balance*100000, 3, ',', '.')}} CHF 

                                            </strong>
                                        </small>
                                    </div>
                                                                    
                                    <div class="description mt-1">
                                        {{$transaction->description}}
                                        <span style="display: block;">
                                            <img src="{{url('/images/neotracker.png')}}" style="height: 35px;" alt="">
                                            <b>TXID:</b> {{$transaction->txid}} 
                                            <br>
                                            <b>Transaction ID:</b> {{$transaction->id}}
                                        </span>
                                        <strong>Date:</strong> {{$transaction->created_at->format('y-m-d h:i:s')}}
                                    </div>
                                </div>
                            </div>
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



@endsection