<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/templates/adminlte/dist/css/adminlte.min.css">
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/templates/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css">
<!-- BEGIN THEME STYLES -->
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/libs/slick/slick/slick.css">
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/libs/slick/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="{{config('app.base_assets_uri')}}/templates/metronic/assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- load css lib / class / library from controller start here -->
@if(isset($load_css) && !empty($load_css))
    @foreach ($load_css AS $key => $values)
        <link href="{{$_config_lib_url . $values}}" rel="stylesheet" type="text/css"/>
    @endforeach
@endif