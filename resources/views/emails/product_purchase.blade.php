@extends('emails.template')
@section('title')
    PRODUCT PURCHASE
@endsection

@section('content')
    <p>Hello, {{$user->name}} </p>

    <p>
        We inform you that with your account a purchase of a product is 
        processed with the following information:
    </p>

    <p>
        <b>{{$product->title}}</b>
        <br>
        {{$product->description}}
    </p>
    
    </p>
        We also attach the details of the transaction.
        <table style="width: 100%;">
            <tr>
                <td>
                    ID
                </td>
                <td>
                    {{$transaction->id}}
                </td>
            </tr>
            <tr>
                <td>
                    TXID
                </td>
                <td>
                    {{$transaction->txid}}
                </td>
            </tr>
            <tr>
                <td>
                    Amount
                </td>
                <td>
                    {{number_format($transaction->amount, 10, ',', '.')}}
                </td>
            </tr>
            <tr>
                <td>
                    Currency
                </td>
                <td>
                    {{$transaction->currency_name}}
                </td>
            </tr>
        </table>
    </p>

    <br>
    <p>
        For more information we invite you to review this transaction in your control panel.
    </p>
@endsection