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

/**
 * Description of GroupPermissionController
 *
 * @author I00396.ARIF
 */
class GroupsPermissionsController extends Controller {

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
                'title' => 'Group Permission',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/group_permission/view'
            ]
        ];
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumb'));
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
                'title' => 'Group Permission',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri') . '/group_permission/view'
            ],
            [
                'id' => 3,
                'title' => 'Group Permission Edit ( id ' . base64_decode($id) . ' )',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/group_permission/edit/' . $id
            ]
        ];
        $modules = Tbl_user_a_permissions::fnGetModules($request);
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumb', 'modules'));
    }

}
