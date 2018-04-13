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
                                About us
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
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam voluptate enim cum fugiat expedita! Eaque consequuntur placeat ipsa temporibus sapiente alias suscipit, voluptatum rem eos odio quod obcaecati inventore aliquam.
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