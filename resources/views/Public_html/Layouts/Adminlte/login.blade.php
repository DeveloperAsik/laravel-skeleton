<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{$title_for_layout ? $title_for_layout : config('app.title_for_layout')}}</title>
        <link rel="icon" type="image/x-icon" href="{{config('app.base_assets_uri')}}/favicon.png">
        @include('Public_html.Layouts.Adminlte.Includes.index.include_meta')
        @include('Public_html.Layouts.Adminlte.Includes.login.include_css')
    </head>
    <body class="hold-transition login-page">
        @include('Public_html.Layouts.Adminlte.Includes.index.message_box')
        @include('Public_html.Components.content')
        <!-- /.login-box -->
        @include('Public_html.Layouts.Adminlte.Includes.login.include_js')
    </body>
</html>
