@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="title">
            <h1>Categories
            </h1>
            <p>
                Management and control of system categories
            </p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">

    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm">Create new category</button>

            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <br>
                            <button class="btn btn-success" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row mt-3 transactions_list">
        <div class="col-md-12">

            <table class="table_dt table table-hover table-striped table-bordered" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Opt</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Transactions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Category::all() as $category)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 10px;">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        
                                        @if(\App\Transaction::where('category_id', $category->id)->count() == 0)
                                            <li>
                                                <a class="dropdown-item" href="{{url('/cp/admin/categories/destroy/'.$category->id)}}">Remove</a>
                                            </li>
                                        @endif
                                            
                                        @if($category->status == 0)
                                            <li>
                                                <a class="dropdown-item" href="{{url('/cp/admin/categories/change_status/'.$category->id)}}">Enable</a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item" href="{{url('/cp/admin/categories/change_status/'.$category->id)}}">Disabled</a>
                                            </li>
                                        @endif
                                        
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $category->id }}
                            </td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                @if($category->status == 0)
                                    <div class="label label-danger">
                                        Inactive
                                    </div>
                                @else
                                    <div class="label label-success">
                                        Active
                                    </div>
                                @endif
                            </td>
                            <td>
                                {{ \App\Transaction::where('category_id', $category->id)->count() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    </div>

@endsection