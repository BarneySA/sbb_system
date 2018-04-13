@extends('parts.template')
@section('content')

<div class="billboard">
    <div class="bg">
    <div class="pattern">
        <div class="container">
            <div class="row">
                <div class="col-md-5">



                    <div class="content">
                        <div class="text_footer">
                            <h1>
                                Contact us
                            </h1>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut libero, non nihil. Blanditiis magni tempora
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-12 pt-5 pb-5">
            <form action="">
            <div class="row">
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="text" class="form-control inverse" placeholder="Email">
                    <p class="text-muted mt-1">Enter a valid email, to be able to contact you as soon as possible!</p>
                </div>
                <div class="col-md-6">
                    <label>Motive</label>
                    <input type="text" class="form-control inverse" placeholder="Motive">
                </div>
            </div>

                <a href="" class="btn-sb">
                    Contact now
                </a>
            </form>
        </div>
    </div>
</div>

<style>
    .billboard,
    .billboard .bg,
    .billboard .pattern .content,
    .billboard .pattern {
        min-height: 47vh !important;
        height: auto !important;
    }

    @media (max-width: 768px) {
        .billboard,
        .billboard .bg,
        .billboard .pattern .content,
        .billboard .pattern {
            min-height: auto !important;
            height: auto !important;
        }

        .billboard h1 {
            margin-top: 160px;
        }
    }
</style>
@endsection