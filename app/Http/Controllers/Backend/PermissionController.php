<?php

namespace App\Http\Controllers\Backend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Tbl_user_a_permissions;

/**
 * Description of PermissionController
 *
 * @author I00396.ARIF
 */
class PermissionController extends Controller {

    //put your code here
    public function view(Request $request) {
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
                'title' => 'Permission',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/permission/view'
            ]
        ];
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout', '_breadcrumb'));
    }

    public function edit(Request $request, $id = null) {
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
                'title' => 'Permission',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri') . '/permission/view'
            ],
            [
                'id' => 3,
                'title' => 'Permission Edit ( id ' .base64_decode($id) .' )',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/permission/edit/' . $id
            ]
        ];
        $modules = Tbl_user_a_permissions::fnGetModules($request);
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout', '_breadcrumb', 'modules'));
    }

}
