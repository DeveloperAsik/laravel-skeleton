<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{$title_for_layout ? $title_for_layout : config('app.title_for_layout')}}</title>
        <link rel="icon" type="image/x-icon" href="{{config('app.base_assets_uri')}}/favicon.png">
        @include('Public_html.Layouts.Adminlte.Includes.dashboard.include_meta')
        @include('Public_html.Layouts.Adminlte.Includes.dashboard.include_css')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            @include('Public_html.Layouts.Adminlte.Includes.dashboard.message_box')
            @include('Public_html.Layouts.Adminlte.Includes.dashboard.preloader')
            <!-- Navbar -->
            @include('Public_html.Layouts.Adminlte.Includes.dashboard.navbar')
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            @include('Public_html.Layouts.Adminlte.Includes.dashboard.sidebar_menu')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @include('Public_html.Layouts.Adminlte.Includes.dashboard.content_header')
                <!-- /.content-header -->
                <!-- Main content -->
                @include('Public_html.Components.content')
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
            <!-- Main Footer -->
            @include('Public_html.Layouts.Adminlte.Includes.dashboard.footer')
        </div>
        @include('Public_html.Components.modal')
        <!-- ./wrapper -->
        <!-- REQUIRED SCRIPTS -->
        @include('Public_html.Layouts.Adminlte.Includes.dashboard.include_js')
    </body>
</html>
