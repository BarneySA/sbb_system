@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="title">
            <h1>Send balance to: {{$user->name}}</h1>
            <p>Enter the amount you want to send, and it will be processed in the next few minutes.</p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">


    <div class="row mt-3 userlist_">
        <div class="col-md-12">


            @if(session('status')!=null)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        {{session('status')}}
                    </div>
                </div>
            </div>
            @endif

            @if(session('success')!=null)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            </div>
            @endif


            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-grouo">
                            <label>Indicate the amount to send</label>
                            <input type="text" name="amount" placeholder="00.1" class="form-control">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success">
                            Send
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>
    




@endsection