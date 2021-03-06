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
                                SwissPass – the key to mobility and leisure.
                            </h1>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut libero, non nihil. Blanditiis magni tempora sint labore odit, laboriosam tempore quia sequi esse, id dicta dolor ab expedita eius, itaque.
                            </p>
                            <a href="#" class="btn-sb transparent">
                                More information
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


<a name="register" style="float: left; margin-top: -150px; visibility: hidden;">
</a>

<div class="create_your_acc">
    <div class="bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 login" id="login">
                    <div class="content">
                        <h3>Why get a passport?</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat et fugit ducimus soluta neque quia ipsum sed, obcaecati. A aliquam magni tenetur dolorum laborum ipsa ad, sint cumque optio excepturi.
                        </p>

                        <h3>
                            Log in now
                        </h3>
                        @include('users.forms.login')
                    </div>
                </div>

                <div class="col-md-6 register">
                    <div class="content">
                        <h3>Register your account now! <small>
                            Complete the fields carefully to obtain your passport.
                        </small></h3>
                        @include('users.forms.register')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection