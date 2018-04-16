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
                                Thanks for your answer
                            </h1>
                            <p>
                                We have decided, if your answer was negative, reimburse the entire amount of your purchase.
                            </p>
                            <a href="{{url('/cp/users')}}" class="btn-sb transparent">
                                Go to my panel
                            </a>
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