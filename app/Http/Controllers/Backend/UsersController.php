<?php

namespace App\Http\Controllers\Backend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\MyHelper;
use App\Models\Tables\Tbl_user_a_groups;

/**
 * Description of UsersController
 *
 * @author elitebook
 */
class UsersController extends Controller {

    //put your code here

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
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumbs'));
    }

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
                'title' => 'User list',
                'icon' => '',
                'arrow' => true,
                'path' => config('app.base_extraweb_uri') . '/user/view'
            ],
            [
                'id' => 3,
                'title' => 'Create new user',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/user/create'
            ]
        ];
        $groups = Tbl_user_a_groups::get_all($request);
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumbs', 'groups'));
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
        return view('Public_html.Layouts.Adminlte.dashboard', compact('title_for_layout', '_breadcrumb', 'modules'));
    }

    public function insert(Request $request) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            $insert_data = [
                'user_name' => $data['user_name'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'is_active' => (int)$data['is_active'],
                'created_by' => $this->__user_id,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_by' => $this->__user_id,
                'updated_date' => date('Y-m-d H:i:s')
            ];
            $response = DB::table('tbl_user_a_users')->insert($insert_data);
            if ($response) {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully insert user', 'valid' => true]);
            } else {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed insert user.', 'valid' => false]);
            }
        }
    }

    public function update(Request $request, $id = null) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            switch ($data['action']) {
                case 'is_active':
                    $update_data = [
                        'is_active' => (int) $data['is_active'],
                        'updated_by' => $this->__user_id,
                        'updated_date' => date('Y-m-d H:i:s')
                    ];
                    break;
                default:
                    $update_data = [
                        'user_name' => $data['user_name'],
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'email' => $data['email'],
                        'is_active' => (int) $data['is_active'],
                        'updated_by' => $this->__user_id,
                        'updated_date' => date('Y-m-d H:i:s')
                    ];
                    break;
            }
            $response = DB::table('tbl_user_a_users')->where('id', '=', (int) $id)->update($update_data);
            if ($response) {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update user', 'valid' => true]);
            } else {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed update user.', 'valid' => false]);
            }
        }
    }

}
