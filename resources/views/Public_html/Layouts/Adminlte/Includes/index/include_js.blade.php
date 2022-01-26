<!-- jQuery -->
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/raphael/raphael.min.js"></script>
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes)
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/dist/js/pages/dashboard2.js"></script> -->

<script src="{{config('app.base_assets_uri')}}/libs/slick/slick/slick.js"></script> 
<script src="{{config('app.base_assets_uri')}}/js/base64.js" type="text/javascript"></script>
<script src="{{config('app.base_assets_uri')}}/js/dateFormat.min.js" type="text/javascript"></script>
<script src="{{config('app.base_assets_uri')}}/libs/toastr/build/toastr.min.js"></script>
<script src="{{config('app.base_assets_uri')}}/libs/bodymovin/5.6.5/lottie.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<script>
@if(isset($_uuid) && !empty($_uuid))
    var _uuid = '{{$_uuid}}';
@else
    var _uuid = '';
@endif
@if(config("app.url"))
    var _base_url = '{{config("app.url")}}';
@else
    var _base_url = '';
@endif
@if(config("app.base_extraweb_uri"))
    var _base_extraweb_uri = '{{config("app.base_extraweb_uri")}}';
@else
    var _base_extraweb_uri = '';
@endif
@if(config("app.base_api_url"))
    var _base_api_url = '{{config("app.base_api_url")}}';
@else
    var _base_api_url = '';
@endif
@if(config("app.base_assets_uri"))
    var _base_assets_url = '{{config("app.base_assets_uri")}}';
@else
    var _base_assets_url = '';
@endif
@if(config("app.base_static_uri"))
    var _base_static_url = '{{config("app.base_static_uri")}}';
@else
    var _base_static_url = '';
@endif
@if(config("app.base_media_uri"))
    var _base_media_url = '{{config("app.base_media_uri")}}';
@else
    var _base_media_url = '';
@endif
@if(isset($_is_logged_in) && !empty($_is_logged_in)) 
    var _is_logged_in = '{{$_is_logged_in}}';
@else
    var _is_logged_in = '';
@endif
@if($_env)) 
    var _env = '{{$_env}}';
@else
    var _env = '';
@endif
</script>

<!-- load system variable to js function start here -->
@if (isset($js_var) && !empty($js_var))
    <script>
    @foreach ($js_var AS $key => $values)
        @foreach ($values AS $k => $v)
            @if ($k == 'app')
                @foreach ($v AS $j => $n)
                       @php 'var ' . $j = '{{$n}}'; @endphp
                @endforeach
            @endif
            @if ($k == 'config')
                @foreach ($v AS $j => $n)
                        @php 'var '. $j = '{{$n}}'; @endphp
                @endforeach
            @endif
            @if ($k == 'path')
                @foreach ($v AS $j => $n)
                        @php'var '. $j  = '{{$n}}'; @endphp
                @endforeach
            @endif
            @if ($k == 'options')
                @foreach ($v AS $j => $n)
                       @php'var '. $j  = '{{$n}}'; @endphp
                @endforeach
            @endif
            @if ($k == 'appUri')
                @foreach ($v AS $j => $n)
                       @php'var '. $j  = '{{$n}}'; @endphp
                @endforeach
            @endif

        @endforeach
    @endforeach
    </script>
@endif
<!-- load system variable to js function start here -->

<!-- load variable to js function from controller start here -->
@if (isset($load_ajax_var) && !empty($load_ajax_var)) 
    @foreach ($load_ajax_var AS $key => $values)
        <script> var {{$values['key']}} = '{{$values["val"]}}';</script>
    @endforeach
@endif
<!-- load variable to js function from controller end here -->

<!-- load js lib / class / library from controller start here -->
@if (isset($load_js) && !empty($load_js))
    @foreach ($load_js AS $key => $values)
        <script src="{{config('app.base_static_uri')}}/js/{{$values}}" type="text/javascript"></script>
    @endforeach;
@endif
<!-- load js lib / class / library from controller end here -->


<!-- load global js lib for every controller start here -->
@if ($_path_app_global_js)
    @include("{$_path_app_global_js}")
@endif
<!-- load global js lib for every controller end here -->

<!-- load specified js lib for a view start here -->
@if(isset($_default_views) && !empty($_default_views))
    @foreach($_default_views AS $keyword => $value)
        @if($keyword == 'js')
            @include($value)   
        @endif
    @endforeach
@endif

