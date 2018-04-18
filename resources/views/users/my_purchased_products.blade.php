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
                                            <strong>{{number_format($transaction->amount, 10, ',', '.')}} SBB - Token </strong>
                                        </small>
                                    </div>
                                                                    
                                    <div class="description mt-1">
                                        {{$transaction->description}}
                                        <span style="display: block;">
                                            <b>TXID:</b> {{$transaction->txid}} 
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