<?php

namespace App\Http\Controllers\Backend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\Controller;
/**
 * Description of DefaultController
 *
 * @author I00396.ARIF
 */
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Tbl_user_a_permissions;
use App\Models\Tbl_user_a_users;

/**
 * Description of Dashboard
 *
 * @author I00396.ARIF
 */
class DashboardController extends Controller {

    //put your code here
    public function index(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout'));
    }

    public function profile(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        $_breadcrumb = [
            [
                'id' => 1,
                'title' => 'Dashboard',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.url')
            ],
            [
                'id' => 2,
                'title' => 'User',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.url')
            ],
            [
                'id' => 3,
                'title' => 'Profile',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.url')
            ]
        ];
        $user = Tbl_user_a_users::fnGetUserProfiles($request);
        $_modal_data = [
            [
                'id' => "modal_change_picture",
                'path' => "Public_html.Modals.Extraweb.User.modal_change_picture"
            ]
        ];
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout', '_breadcrumb', '_modal_data', 'user'));
    }

    public function profile_update(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        $_breadcrumb = [
            [
                'id' => 1,
                'title' => 'Dashboard',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri')
            ],
            [
                'id' => 2,
                'title' => 'User',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri')
            ],
            [
                'id' => 3,
                'title' => 'Profile',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri') . '/profile'
            ],
            [
                'id' => 3,
                'title' => 'Update',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/profile/update'
            ]
        ];
        $user = Tbl_user_a_users::fnGetUserProfiles($request);
        $modules = Tbl_user_a_permissions::fnGetModules($request);
        $_modal_data = [
            [
                'id' => "modal_change_picture",
                'path' => "Public_html.Modals.Extraweb.User.modal_change_picture"
            ]
        ];
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout', '_breadcrumb', '_modal_data', 'user', 'modules'));
    }

    
    public function fnUploadPhoto(Request $request) {
        if (isset($request) && !empty($request)) {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file_size = $file->getSize();
            $file_extension = $file->getClientOriginalExtension();
            $path = '/__media/images/user_profiles';
            $result = $file->move(public_path() . $path, $file_name);
            if ($result) {
                $profile_user = DB::table('tbl_user_c_tokens AS a')
                                ->select('a.id', 'a.profile_id')
                                ->where('a.user_id', '=', $this->__user_id)->first();
                DB::table('tbl_user_a_profiles')->where('id', $profile_user->profile_id)->update(['img' => $path . '/' . $file_name]);
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully upload picture', 'valid' => true, 'data' => ['path' => $path . '/' . $file_name]]);
            } else {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed upload picture', 'valid' => false, 'data' => null]);
            }
        }
    }

    public function preference(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout'));
    }

    public function widget(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout'));
    }

}
