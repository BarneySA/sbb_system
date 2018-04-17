@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="title">
            <h1>Categories</h1>
            <p>
                Management and control of system categories
            </p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">


    <div class="row mt-3 transactions_list">
        <div class="col-md-12">

            <table class="table_dt table table-hover table-striped table-bordered" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Opt</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Transactions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

        </div>
    </div>


    </div>

@endsection