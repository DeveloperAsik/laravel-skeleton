<!doctype html>
<html lang="en">
    <head>
        <title>{{$title_for_layout ? $title_for_layout : config('app.title_for_layout')}}</title>
        <link rel="icon" type="image/x-icon" href="{{config('app.base_assets_uri')}}/favicon.png">
        @include('Public_html.Layouts.Adminlte.Includes.home.include_meta')
        @include('Public_html.Layouts.Adminlte.Includes.home.include_css')
    </head>
    <body>
        <header>
            @include('Public_html.Layouts.Adminlte.Includes.home.nav')
        </header>
        <main>
            @include('Public_html.Components.content')
            @include('Public_html.Layouts.Adminlte.Includes.home.footer')
        </main>
        @include('Public_html.Layouts.Adminlte.Includes.home.include_js')
    </body>
</html>
