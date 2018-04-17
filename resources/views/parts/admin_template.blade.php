<!DOCTYPE html>
<html lang="en">
    <head>                        
        <title>SBB</title>            
        
        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" href="{{ url('/boooya/build') }}/css/styles.css">
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>        
        
        <!-- APP WRAPPER -->
        <div class="app">           

            <!-- START APP CONTAINER -->
            <div class="app-container">
                <!-- START SIDEBAR -->
                <div class="app-sidebar app-navigation  app-navigation-fixed app-navigation-style-default dir-left" data-type="close-other">
                    <a href="{{ url('/cp/users') }}" class="app-navigation-logo"></a>
                    <nav>
                        <ul>                            
                            <li>
                                <a  href="{{ url('/cp/admin') }}">
                                    <span class="nav-icon-hexa">Ho</span>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/cp/admin/categories')}}">
                                    <span class="nav-icon-hexa">Ca</span>
                                    Categories
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/cp/admin/products')}}">
                                    <span class="nav-icon-hexa">Pr</span>
                                    Products
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/cp/admin/transactions')}}">
                                    <span class="nav-icon-hexa">Tr</span>
                                    Transactions
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/cp/admin/users')}}">
                                    <span class="nav-icon-hexa">Us</span>
                                    Users
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/logouth')}}">
                                    <span class="nav-icon-hexa">Lo</span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- END SIDEBAR -->
                
                <!-- START APP CONTENT -->
                <div class="app-content app-sidebar-left">
                    <!-- START APP HEADER -->
                    <div class="app-header">
                        <ul class="app-header-buttons">
                            <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                            <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-list"></span></a></li>
                        </ul>

                        <ul class="app-header-buttons pull-right">           
                            <li>
                                <a href={{ url('/logouth') }}" class="btn btn-default btn-icon"><span class="icon-power-switch"></span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- END APP HEADER  -->
                    
                    @yield('content')
                    
                </div>
                <!-- END APP CONTENT -->
                                
            </div>
            <!-- END APP CONTAINER -->
            
        </div>        
        <!-- END APP WRAPPER -->                
        
        <!-- START SCRIPTS -->
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/moment/moment.min.js"></script>       
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/bootstrap-select/bootstrap-select.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/select2/select2.full.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/maskedinput/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/form-validator/jquery.form-validator.min.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/noty/jquery.noty.packaged.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/datatables/dataTables.bootstrap.min.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/sweetalert/sweetalert.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/knob/jquery.knob.min.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/jvectormap/jquery-jvectormap.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/sparkline/jquery.sparkline.min.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/morris/raphael.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/morris/morris.min.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/rickshaw/rickshaw.min.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/isotope/isotope.pkgd.min.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/dropzone/dropzone.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/nestable/jquery.nestable.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/cropper/cropper.min.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/tableexport/tableExport.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/tableexport/jquery.base64.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/tableexport/html2canvas.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/tableexport/jspdf/libs/sprintf.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/tableexport/jspdf/jspdf.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/tableexport/jspdf/libs/base64.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/bootstrap-daterange/daterangepicker.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/bootstrap-tour/bootstrap-tour.min.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/fullcalendar/fullcalendar.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/vendor/smartwizard/jquery.smartWizard.js"></script>
        
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/app.js"></script>
        <script type="text/javascript" src="{{ url('/boooya/build') }}/js/app_plugins.js"></script>
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css">
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function(){
                $('.table_dt').DataTable({
                    "responsive": true
                });
                $( ".date" ).datepicker({ 
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'yy-mm-dd',
                    yearRange: "-100:+0"
                });
            });
        </script>

        <style>

            .app .table tr td, .app .table tr th {
                line-height: 1;
                padding: 2px 15px;
            }

            table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc_disabled:before {
                top: 1px;
            }

            table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
                top: 1px;
            }

            .table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > td {
                padding: 10px 15px;
            }

        </style>
        
    </body>
</html>