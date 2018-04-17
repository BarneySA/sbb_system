@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="icon icon-lg">
            <span class="icon-home"></span>
        </div>
        <div class="title">
            <h1>Home</h1>
            <p>Welcome</p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">
    <div class="row">
        <div class="col-md-3">                                    
            <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">                                                                                    
                <div class="line">
                    <div class="title">Sales</div>
                </div>
                <div class="intval intval-lg">
                    {{\App\Transaction::where('refund', 0)->count()}}
                </div>
                <div class="line">
                    <div class="subtitle">Total sales</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">                                    
            <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">                                                                                    
                <div class="line">
                    <div class="title">Gains</div>
                </div>
                <div class="intval intval-lg">
                    {{number_format(collect(\App\Transaction::where('refund', 0)->get())->sum('amount'), 10, ',', '.')}}
                </div>
                <div class="line">
                    <div class="subtitle">Gains in GAS</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">                                    
            <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">                                                                                    
                <div class="line">
                    <div class="title">Total refunds made</div>
                </div>
                <div class="intval intval-lg">
                    {{\App\Transaction::where('refund', 1)->count()}}
                </div>
                <div class="line">
                    <div class="subtitle">Refunds made</div>
                </div>
            </div>
        </div>


    </div>
        
        
    </div>
    <!-- END PAGE CONTAINER -->

@endsection