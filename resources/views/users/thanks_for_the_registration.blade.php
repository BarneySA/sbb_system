@extends('parts.template')
@section('content')

<div class="billboard">
    <div class="bg">
    <div class="pattern">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">



                    <div class="content">
                        <div class="text_footer">
                            <h1>
                                <br>
                                Thanks for the registration
                            </h1>
                            <p>
                                Your registration was completed successfully, please check your email to activate your account and you can make full use of the system that we offer.

                            </p>
                            <a href="{{url('/#login')}}" class="btn-sb transparent">
                                Go to login
                            </a>
                            {{--
                            <a href="{{url('/')}}" class="btn btn-link" style="color: #fff;">
                                Forward verification mail
                            </a>
                            --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


<style>
    .billboard .pattern .content .text_footer h1, .billboard .pattern .content .text_footer p {
        text-align: center;
    }

    .billboard .pattern .content .text_footer {
        vertical-align: middle;
        text-align: center;
    }

    .billboard {
        background-image: url({{url('/images/bgs/233677-P2CESS-970.jpg')}}) !important;
    }
</style>
@endsection