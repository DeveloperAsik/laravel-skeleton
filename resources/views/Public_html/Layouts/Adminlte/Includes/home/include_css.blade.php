<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">
<!-- Bootstrap core CSS -->
<link href="{{config('app.base_assets_uri')}}/libs/bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
<!-- Custom styles for this template -->
<link href="{{config('app.base_assets_uri')}}/libs/toastr/build/toastr.min.css" rel="stylesheet"/>
<!-- BEGIN THEME STYLES -->
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/libs/slick/slick/slick.css">
<link rel="stylesheet" href="{{config('app.base_assets_uri')}}/libs/slick/slick/slick-theme.css">
<link href="{{config('app.base_assets_uri')}}/css/carousel.css" rel="stylesheet">
@if(isset($load_css) && !empty($load_css))
    @foreach ($load_css AS $key => $values)
        <link href="{{$_config_lib_url . $values}}" rel="stylesheet" type="text/css"/>
    @endforeach
@endif