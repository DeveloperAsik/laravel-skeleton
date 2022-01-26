<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use View;
use App\Models\Tbl_user_c_extraweb_sidebars AS Tbl_extraweb_sidebar;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function __construct(Request $request) {
        $header = $request->header('Authorization');
        if (isset($header) && !empty($header)) {
            $tokenParts = explode('.', $header);
            $payload = json_decode(base64_decode($tokenParts[1]));
            $this->__user_id = $payload->user_id;
            $this->__group_id = $payload->group_id;
            $this->__user_name = $payload->user_name;
            $this->__user_email = $payload->email;
        }
        $data = $request->session()->all();
        if (isset($data['_session_is_logged_in']) && !empty($data['_session_is_logged_in']) && $data['_session_is_logged_in'] == true) {
            $this->__is_logged_in = $data['_session_is_logged_in'];
            View::share('__is_logged_in', $data['_session_is_logged_in']);
            $this->__user_id = $data['_session_user_id'];
            View::share('__user_id', $data['_session_user_id']);
            $this->__group_id = $data['_session_group_id'];
            View::share('__group_id', $data['_session_group_id']);
            $this->__user_name = $data['_session_user_name'];
            View::share('__user_name', $data['_session_user_name']);
            $this->__user_email = $data['_session_user_email'];
            View::share('__user_email', $data['_session_user_email']);
        }
        $this->init_global_var($request);
    }

    public function load_css($class = array()) {
        if ($class) {
            View::share('load_css', $class);
        }
    }

    public function load_js($class = array()) {
        if ($class) {
            View::share('load_js', $class);
        }
    }

    public function load_ajax_var($values = array()) {
        if ($values) {
            View::share('load_ajax_var', $values);
        }
    }

    public function init_global_var($request) {
        if (!$request->session()->get('_uuid') || $request->session()->get('_uuid') == null) {
            $request->session()->put('_uuid', uniqid());
        }
        View::share('_uuid', $request->session()->get('_uuid'));
        //init date now
        View::share('_date_now', MyHelper::idnDate('l, j F Y H:i'));
        //env
        View::share('_env', config('env'));

        //init days name
        $days_name = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $this->days_name = $days_name;
        View::share('_days_name', $days_name);

        //init month name
        $month_name = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', ' Desember'];
        $this->month_name = $month_name;
        View::share('_months_name', $month_name);

        //init global js
        $path_app_global_js = 'Public_html.Helpers.global_js';
        View::share('_path_app_global_js', $path_app_global_js);

        //init class & method name
        $class_name = str_replace('Controller', '', MyHelper::getRoutes('controller'));
        $method_name = MyHelper::getRoutes('action');

        $routeArray = app('request')->route()->getAction();
        $namespace = $routeArray['namespace'];
        $path_without_namespace = str_replace($namespace, '', $routeArray['uses']);
        //$path = str_replace('\\', '.', $path_without_namespace);
        $path_ = explode('\\', $path_without_namespace);
        $controller = $class_name . 'Controller@' . $method_name;
        $controller_path = $path_[3]; // str_replace($controller, '', $path);
        $views = array(
            'class' => $class_name,
            'method' => $method_name,
            'html' => 'Public_html.Pages.' . $controller_path . '.' . $class_name . '.' . $method_name . '_html',
            'js' => 'Public_html.Pages.' . $controller_path . '.' . $class_name . '.' . $method_name . '_js'
        );
        View::share('_default_views', $views);
        $arr_nav_menu = [
            [
                'id' => 1,
                'title' => 'Profile',
                'key' => 'profile',
                'path' => config('app.base_extraweb_uri') . '/profile'
            ],
            [
                'id' => 2,
                'title' => 'Preference',
                'key' => 'preference',
                'path' => config('app.base_extraweb_uri') . '/preference'
            ],
            [
                'id' => 3,
                'title' => 'Widget',
                'key' => 'widget',
                'path' => config('app.base_extraweb_uri') . '/widget'
            ]
        ];
        View::share('_menu_navigation', json_decode(json_encode($arr_nav_menu)));
        $arr_breadcrumbs = [
            [
                'id' => 1,
                'title' => 'Home',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.url')
            ]
        ];
        View::share('breadcrumbs', json_decode(json_encode($arr_breadcrumbs)));
        if (isset($this->__group_id) && !empty($this->__group_id)) {
            $sidebar_menu = Tbl_extraweb_sidebar::get_sidebar_menu($request, $this->__group_id);
            if (isset($sidebar_menu) && !empty($sidebar_menu)) {
                View::share('_sidebar_menu', json_decode(json_encode($sidebar_menu)));
            }
        }
    }

}
