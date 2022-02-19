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
use App\Models\Tables\Tbl_user_a_modules;

/**
 * Description of PermissionController
 *
 * @author I00396.ARIF
 */
class PermissionController extends Controller {

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
        $modules = Tbl_user_a_modules::fnGetModules($request);
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
                'title' => 'Permission',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri') . '/permission/view'
            ],
            [
                'id' => 3,
                'title' => 'Permission Edit ( id ' . base64_decode($id) . ' )',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/permission/edit/' . $id
            ]
        ];
        $modules = Tbl_user_a_modules::fnGetModules($request);
        $permission = DB::table('tbl_user_d_permissions AS a')->select('*')->where('id', '=', $id)->first();
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumb', 'modules', 'permission'));
    }

    public function update(Request $request, $id = null) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            switch ($data['action']) {
                case 'is_active':
                    $update_data = [
                        'is_active' => $data['is_active'],
                        'updated_by' => $this->__user_id,
                        'updated_date' => date('Y-m-d H:i:s')
                    ];
                    break;
                default:
                    $update_data = [
                        'route_name' => $data['route_name'],
                        'url' => $data['url'],
                        'class' => $data['class'],
                        'method' => $data['method'],
                        'module_id' => $data['module_id'],
                        'is_active' => $data['is_active'],
                        'updated_by' => $this->__user_id,
                        'updated_date' => date('Y-m-d H:i:s')
                    ];
                    break;
            }
            $response = DB::table('tbl_user_d_permissions')->where('id', '=', (int) $id)->update($update_data);
            if ($response) {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update modules', 'valid' => true]);
            } else {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed update modules.', 'valid' => false]);
            }
        }
    }

    public function view(Request $request) {
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
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/permission/view'
            ]
        ];
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumbs'));
    }

}
