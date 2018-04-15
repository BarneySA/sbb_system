@extends('users.template')
@section('user_content')
    <div class="row mt-3 userlist_">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <h3>
                        Send balance to: {{$user->name}}
                    </h3>
                    <p class="text-muted">
                        Enter the amount you want to send, and it will be processed in the next few minutes.
                    </p>
                </div>
            </div>

            @if(session('status')!=null)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger text-danger">
                        {{session('status')}}
                    </div>
                </div>
            </div>
            @endif

            @if(session('success')!=null)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success text-success">
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
                        <button type="submit" class="btn-sb">
                            Send
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    




@endsection