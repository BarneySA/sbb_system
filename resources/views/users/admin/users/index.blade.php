@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="title">
            <h1>Users</h1>
            <p>Manage and control all system users</p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">
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
        

        <table class="table_dt table table-hover table-striped table-bordered" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Options</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Balance</th>
                    <th>Transactions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(App\User::all() as $user)
                <tr>
                    <td>
                        <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 10px;">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <li>
                                <a class="dropdown-item" href="{{url('/cp/admin/send/GAS/'.$user->id)}}">Send SBB - Token</a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="{{url('/cp/admin/send_reward/'.$user->id)}}">Send reward</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{url('/cp/admin/change_status_acc/'.$user->id)}}">Deactivate account</a>
                            </li>

                            
                        </div>
                        </div>
                    </td>
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
                        {{number_format(App\User::auth($user->id)->balance->GAS->balance, 10, ',', '.')}}  SBB Token
                        @php
                            $client = new \GuzzleHttp\Client();
                            $gas_amount = $client->get('https://api.coinmarketcap.com/v1/ticker/gas/?convert=CHF')->getBody();
                            $gas_amount = json_decode($gas_amount);
                                
                            $balance = App\User::auth($user->id)->balance->GAS->balance * $gas_amount[0]->price_chf;

                        @endphp
                        <br>
                        {{number_format($balance, 10, ',', '.')}} CHF 
                    </td>
                    <td>
                        {{App\Transaction::where('user_id', $user->id)->count()}}
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
        
    </div>

@endsection