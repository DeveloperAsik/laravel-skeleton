<?php

namespace App\Http\Controllers\Backend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tables\Tbl_user_a_groups;

/**
 * Description of GroupController
 *
 * @author elitebook
 */
class GroupsController extends Controller {

    //put your code here

    public function create(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        $_breadcrumbs = [
            [
                'id' => 1,
                'title' => 'Dashboard',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri')
            ],
            [
                'id' => 2,
                'title' => 'Permission list',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri') . '/permission/view'
            ],
            [
                'id' => 2,
                'title' => 'Permission create new',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/permission/create'
            ]
        ];
        $modules = Tbl_user_a_modules::get_all($request);
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumbs', 'modules'));
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
                'title' => 'User',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri') . '/users/view'
            ],
            [
                'id' => 3,
                'title' => 'User Edit ( id ' . base64_decode($id) . ' )',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/users/edit/' . $id
            ]
        ];
        $modules = Tbl_user_a_groups::fnGetModules($request);
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumb', 'modules'));
    }

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
                'title' => 'User',
                'icon' => '',
                'arrow' => true,
                'path' => '#'
            ],
            [
                'id' => 3,
                'title' => 'View',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/users/views'
            ]
        ];
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumb'));
    }

}
