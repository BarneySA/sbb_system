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
                                Welcome, {{\Auth::user()->username}}
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
                            <div class="number">{{\Auth::user()->getAddress}}</div>
                            <div class="name">{{\Auth::user()->username}}</div>
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
                    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">
                        Profile
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#my_transactions" role="tab" data-toggle="tab">
                        My transactions
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#products" role="tab" data-toggle="tab">
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
        <div class="col-md-12 pb-5">

            <!-- Tab panes -->
            <div class="tab-content mt-3">
              <div role="tabpanel" class="tab-pane fade in active" id="profile" style="opacity: 1;">
                    @include('users.tabs.edit_profile')
              </div>
              <div role="tabpanel" class="tab-pane fade" id="my_transactions">
                    @include('users.tabs.my_transactions')
              </div>
              <div role="tabpanel" class="tab-pane fade" id="products">ccc</div>
            </div>

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
            {{App\User::auth()->getAddress}}
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