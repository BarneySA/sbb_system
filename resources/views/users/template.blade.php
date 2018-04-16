@extends('parts.template')
@section('content')

<div class="billboard">
    <div class="bg">
    <div class="pattern">
        <div class="container">
            <div class="row">

                <div class="col-6 col-md-8">
                    <div class="content">
                        <div class="text_footer welcome">
                            <h1>
                                Welcome, {{\Auth::user()->name}}
                            </h1>
                            <p>
                                Manage and manage your account from this control panel!
                            </p>
                            <button class="btn-sb openwalletqr">Add found</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 card_print">
                    <div class="content">
                        <div class="text_footer welcome">

                        <div class="card_wallet">
                            <div class="logo">
                                <img src="{{url('/images/logo2.png')}}" class="logo" alt="Logo SB">
                            </div>
                            <div class="title_wallet">Your wallet number:</div>
                            <div class="number">{{\Auth::user()->wallet_address}}</div>
                            <div class="name">{{\Auth::user()->name}}</div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>

<div class="tabls_con">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('/cp/users/my_transactions')}}">
                        My transactions
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('/products/categories')}}">
                        Products
                    </a>
                  </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="page_profile">
<div class="container">
    <div class="row">
        <div class="col-md-12 pb-5 pt-3">
            @yield('user_content')
        </div>
    </div>
</div>
</div>


<div class="walletqr" >
    <img src="{{url('/images/logo2.png')}}" class="logo" alt="Logo SB">
    <div class="close">
        x
    </div>
    <div class="content">
        <img src="{{App\User::auth()->qr}}" alt="">
        <span>
            {{\Auth::user()->wallet_address}}
        </span>
    </div>
</div>

<style>

    .billboard,
    .billboard .bg,
    .billboard .pattern .content,
    .billboard .pattern {
        min-height: 60vh !important;
        height: auto !important;
    }

    .billboard {
        background-image: url({{url('/images/bgs/115.jpg')}}) !important;
    }

    @media (max-width: 768px) {
        .billboard,
        .billboard .bg,
        .billboard .pattern .content,
        .billboard .pattern {
            min-height: auto !important;
            height: auto !important;
        }

        .billboard .welcome h1 {
            margin-top: 160px;
        }

        .balance_top {
            display: block !important;
            width: 100% !important;
            flex: auto !important;
            max-width: 100% !important;
        }

        .text-right {
            text-align: left !important;
        }

    }
</style>
@endsection