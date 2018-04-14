@extends('emails.template')
@section('title')
    TOKEN
@endsection

@section('content')
    <p>Hola {{$user->name}},</p>
    <p>
        To continue it is important that you enter the following code <b>{{$code}}</b> in the login form. This code will be valid for 15 minutes.
    </p>
@endsection