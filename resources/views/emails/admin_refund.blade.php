@extends('emails.template')
@section('title')
    PRODUCT PURCHASE
@endsection

@section('content')
    <p>Hello, {{$user->name}} </p>

    <p>
        The administrator applies a refund to your account, please check in your account for more information!
    </p>

@endsection