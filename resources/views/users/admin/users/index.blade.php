@extends('users.template')
@section('user_content')
    <div class="row mt-3 userlist_">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <h3>
                        Users
                    </h3>
                    <p class="text-muted">
                        Manage and control all system users
                    </p>
                </div>
            </div>



        </div>
    </div>
    

    <table class="table_dt table table-hover table-striped table-bordered" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Status</th>
                <th>NEO</th>
                <th>GAS</th>
                <th>Transactions</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach(App\User::all() as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    @if($user->role==1)
                    <span class="badge badge-success">
                        Administrator
                    </span>
                    @else
                    <span class="badge badge-default">
                        Client
                    </span>
                    @endif
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    @if($user->status==1)
                    <span class="badge badge-success">
                        Active
                    </span>
                    @else
                    <span class="badge badge-danger">
                        Inative
                    </span>
                    @endif
                </td>
                <td>
                    {{number_format(App\User::auth($user->id)->balance->NEO->balance, 10, ',', '.')}}
                </td>
                <td>
                    {{number_format(App\User::auth($user->id)->balance->GAS->balance, 10, ',', '.')}}
                </td>
                <td>
                    {{App\Transaction::where('user_id', $user->id)->count()}}
                </td>
                <td>
                    <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 3px 10px;">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Complete information</a>
                        <a class="dropdown-item" href="{{url('/cp/admin/send/GAS/'.$user->id)}}">Send GAS</a>
                        <a class="dropdown-item" href="{{url('/cp/admin/send/NEO/'.$user->id)}}">Send NEO</a>
                        <a class="dropdown-item" href="{{url('/cp/admin/change_status_acc/'.$user->id)}}">Deactivate account</a>
                    </div>
                    </div>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    


@endsection