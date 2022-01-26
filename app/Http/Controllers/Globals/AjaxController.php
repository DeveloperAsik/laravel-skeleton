<?php

namespace App\Http\Controllers\Globals;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\TokenUser;
use App\Models\Tbl_menu_a_menus;

/**
 * Description of AjaxController
 *
 * @author I00396.ARIF
 */
class AjaxController extends Controller {

//put your code here

    public function fn_ajax_get(Request $request, $method = '') {
        switch ($method) {
            case "get-permission":
                $response = $this->fn_get_permission($request);
                break;
            case "get-menu":
                $response = $this->fn_get_menu($request);
                break;
            case "get-menu-single":
                $response = $this->fn_get_menu_single($request);
                break;
        }
        return $response;
    }

    protected function fn_get_permission($request) {
        $permissions = DB::table('tbl_user_a_permissions AS a')->select('*')->get();
        return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully fetching permissions data.', 'valid' => true, 'data' => $permissions]);
    }

    protected function fn_get_menu_single($request) {
        $menu = [];
        if ($request->id) {
            $menu = Tbl_menu_a_menus::get_menu_by_id($request->id, 1, 0);
        }
        return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully fetching menu data.', 'valid' => true, 'data' => $menu]);
    }

    protected function fn_get_menu($request) {
        $menu = [];
        if ($request->module_id) {
            $menu_1 = Tbl_menu_a_menus::get_menus($request->module_id, 1, 0);
            if ($menu_1) {
                foreach ($menu_1 AS $keyword => $value) {
                    $menu_2 = Tbl_menu_a_menus::get_menus($request->module_id, ($value->level + 1), $value->id);
                    $arr_menu_2 = [];
                    if ($menu_2) {
                        foreach ($menu_2 AS $key => $val) {
                            $menu_3 = Tbl_menu_a_menus::get_menus($request->module_id, ($val->level + 1), $val->id);
                            $arr_menu_3 = [];
                            if ($menu_3) {
                                foreach ($menu_3 AS $ky => $vl) {
                                    $menu_4 = Tbl_menu_a_menus::get_menus($request->module_id, ($vl->level + 1), $vl->id);
                                    $arr_menu_4 = [];
                                    if ($menu_4) {
                                        foreach ($menu_4 AS $k => $v) {
                                            $arr_menu_4[] = [
                                                "id" => $v->id,
                                                "parent" => $v->parent_id,
                                                "text" => '<button type="button" style="background-color: transparent;border: none;" data-toggle="modal" data-target="#modal_edit_node" data-level="4"  data-id="' . $v->id . '">' . $v->name . '</button>',
                                                "icon" => $v->icon
                                            ];
                                        }
                                    }
                                    $arr_menu_3[] = [
                                        "id" => $vl->id,
                                        "parent" => $vl->parent_id,
                                        "text" => '<button type="button" style="background-color: transparent;border: none;" data-toggle="modal" data-target="#modal_edit_node" data-level="3"  data-id="' . $vl->id . '">' . $vl->name . '</button>',
                                        "icon" => $vl->icon,
                                        "children" => $arr_menu_4
                                    ];
                                }
                            }
                            $arr_menu_2[] = [
                                "id" => $val->id,
                                "parent" => $val->parent_id,
                                "text" => '<button type="button" style="background-color: transparent;border: none;" data-toggle="modal" data-target="#modal_edit_node" data-level="2"  data-id="' . $val->id . '">' . $val->name . '</button>',
                                "icon" => $val->icon,
                                "children" => $arr_menu_3
                            ];
                        }
                    }
                    $menu[] = [
                        "id" => $value->id,
                        "parent" => $value->parent_id,
                        "text" => '<button type="button" style="background-color: transparent;border: none;" data-toggle="modal" data-target="#modal_edit_node" data-level="1" data-id="' . $value->id . '">' . $value->name . '</button>',
                        "icon" => $value->icon,
                        "children" => $arr_menu_2
                    ];
                }
            }
        }
        $root_menu = [
            "id" => "root",
            "text" => "root",
            "icon" => "",
            "children" => $menu
        ];
        return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully fetching menu data.', 'valid' => true, 'data' => $root_menu]);
    }

    public function fn_ajax_post(Request $request, $method = '') {
        switch ($method) {
            case "get_group_permission_list":
                $response = $this->fn_post_get_group_permission_list($request);
                break;
            case "form-detail":
                $response = $this->fn_post_update_form_detail($request);
                break;
            case "form-prefferences":
                $response = $this->fn_post_update_form_prefferences($request);
                break;
            case "form-add-group-permission":
                $response = $this->fn_post_add_group_permission($request);
                break;
            case "update-menu":
                $response = $this->fn_post_update_menu($request);
                break;
        }
        return $response;
    }

    public function fn_post_update_menu(Request $request) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            if ($data['parent'] && $data['parent'] == 'root') {
                $parent_id = 0;
                $level = 1;
                $exist_all = DB::table('tbl_menu_a_menus AS a')->select('*')->where('a.module_id', '=', $data['module_id'])->where('a.level', '=', $level)->where('a.parent_id', '=', $parent_id)->get();
                $total_exist = count($exist_all);
                $rank = $total_exist + 1;
            } else {
                $parent_id = (int) $data['parent'];
                $parent = DB::table('tbl_menu_a_menus AS a')->select('*')->where('a.id', '=', $parent_id)->first();
                $members = DB::table('tbl_menu_a_menus AS a')->select('*')->where('a.parent_id', '=', $parent_id)->get();
                if ($data['is_insert'] == true) {
                    $total_member = count($members);
                    $level = (int) $parent->level + 1;
                    if ($total_member > 0) {
                        $i = $total_member - 1;
                        $rank = (int) $total_member + 1;
                    } else {
                        $rank = 1;
                    }
                }
            }
            if ($data['is_insert'] == true) {
                $param = [
                    'name' => (string) $data['value'],
                    'icon' => '',
                    'path' => '',
                    'level' => $level,
                    'rank' => $rank,
                    'parent_id' => $parent_id,
                    'is_badge' => 0,
                    'is_open' => 0,
                    'is_active' => 1,
                    'module_id' => (int) $data['module_id'],
                    'created_by' => $this->__user_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_date' => date('Y-m-d H:i:s'),
                ];
                $response = DB::table('tbl_menu_a_menus')->insert($param);
            } else {
                $param = [
                    'name' => (string) $data['value']
                ];
                $response = DB::table('tbl_menu_a_menus')->where('id', '=', $data['id'])->update($param);
            }
            if ($response) {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update menu.', 'valid' => true]);
            } else {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update menu.', 'valid' => false]);
            }
        }
    }

    public function fn_post_get_group_permission_list(Request $request) {
        if (isset($request) && !empty($request)) {
            $draw = $request['draw'];
            $start = (int) $request['start'];
            $length = $request['length'];
            $page = 1;
            if ($start > 0) {
                $r = ($start / $length);
                $page = $r + 1;
            }
            $limit = ($request->limit) ? $request->limit : 10;
            $offset = ($request->offset) ? $request->offset : 0;
            $search = $request['search']['value'];
            if (isset($search) && !empty($search)) {
                $data = DB::table('tbl_user_b_group_permissions AS a')
                        ->select('a.id', 'b.url', 'c.id AS module_id', 'c.name AS module_name', 'b.route', 'b.class', 'b.method', 'b.description', 'b.is_active', 'b.is_generated_view', 'd.id AS group_id', 'd.name AS group_name')
                        ->leftJoin('tbl_user_a_permissions AS b', 'b.id', '=', 'a.permission_id')
                        ->leftJoin('tbl_user_a_modules AS c', 'c.id', '=', 'b.module_id')
                        ->leftJoin('tbl_user_a_groups AS d', 'd.id', '=', 'a.group_id')
                        ->where('a.group_id', '=', $this->__group_id)
                        ->where('b.url', 'like', '%' . $search . '%')
                        ->orWhere('c.name', 'like', '%' . $search . '%')
                        ->orWhere('b.route', 'like', '%' . $search . '%')
                        ->orWhere('b.class', 'like', '%' . $search . '%')
                        ->orWhere('b.method', 'like', '%' . $search . '%')
                        ->orWhere('d.name', 'like', '%' . $search . '%')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            } else {
                $data = DB::table('tbl_user_b_group_permissions AS a')
                        ->select('a.id', 'b.url', 'c.id AS module_id', 'c.name AS module_name', 'b.route', 'b.class', 'b.method', 'b.description', 'b.is_active', 'b.is_generated_view', 'd.id AS group_id', 'd.name AS group_name')
                        ->leftJoin('tbl_user_a_permissions AS b', 'b.id', '=', 'a.permission_id')
                        ->leftJoin('tbl_user_a_modules AS c', 'c.id', '=', 'b.module_id')
                        ->leftJoin('tbl_user_a_groups AS d', 'd.id', '=', 'a.group_id')
                        ->where('a.group_id', '=', $this->__group_id)
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            }
            $total_rows = DB::table('tbl_user_b_group_permissions AS a')->count();
            if (isset($data) && !empty($data)) {
                $arr = array();
                foreach ($data AS $keyword => $value) {
                    $is_generated_view = $value->is_generated_view;
                    $generated_view = '';
                    if ($is_generated_view == 1) {
                        $generated_view = ' checked';
                    }
                    $is_active = '';
                    if ($value->is_active == 1) {
                        $is_active = ' checked';
                    }
                    $arr[] = [
                        'id' => $value->id,
                        'url' => $value->url,
                        'module' => $value->module_name,
                        'route' => $value->route,
                        'class' => $value->class,
                        'method' => $value->method,
                        'group_name' => $value->group_name,
                        'description' => $value->description,
                        'is_active' => '<input type="checkbox"' . $is_active . ' name="is_active" class="make-switch" data-size="small">',
                        'is_generated_view' => '<input type="checkbox"' . $generated_view . ' name="is_generated_view" class="make-switch" data-size="small">'
                    ];
                }
                $output = array(
                    'draw' => $draw,
                    'recordsTotal' => $total_rows,
                    'recordsFiltered' => $total_rows,
                    'data' => $arr,
                );
                echo json_encode($output);
            } else {
                echo json_encode(array());
            }
        } else {
            echo json_encode(array());
        }
    }

    protected function fn_post_update_form_detail($request) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            $user = DB::table('tbl_user_a_users AS a')->select('a.id', 'a.user_name', 'a.email', 'a.password')->where('a.id', '=', $this->__user_id)->first();
            $param_update_profile = [
                'user_name' => (string) $data['user_name'],
                'first_name' => (string) $data['first_name'],
                'last_name' => (string) $data['last_name'],
                'email' => (string) $data['email']
            ];
            DB::table('tbl_user_a_users')->where('id', $this->__user_id)->update($param_update_profile);
            if ($data['is_change_pass'] == true) {
                if (isset($user) && !empty($user)) {
                    $verify_hash = TokenUser::__verify_hash(base64_decode($data['old_pass']), $user->password);
                    if ($verify_hash == true) {
                        $hashed_new_pass = TokenUser::__string_hash(base64_decode($data['new_pass1']));
                        DB::table('tbl_user_a_users')->where('id', $this->__user_id)->update([
                            'password' => $hashed_new_pass
                        ]);
                    }
                }
            }
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update user profile.', 'valid' => true]);
        }
    }

    protected function fn_post_update_form_prefferences($request) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            $token_exist = DB::table('tbl_user_c_tokens AS a')->select('a.id', 'a.profile_id', 'a.group_id', 'a.user_id')->where('a.user_id', '=', $this->__user_id)->first();
            $param_update_profile = [
                'facebook' => ($data['facebook']) ? (string) $data['facebook'] : '',
                'twitter' => ($data['twitter']) ? (string) $data['twitter'] : '',
                'instagram' => ($data['instagram']) ? (string) $data['instagram'] : '',
                'linkedin' => ($data['linkedin']) ? (string) $data['linkedin'] : '',
                'last_education' => ($data['last_education']) ? (string) $data['last_education'] : '',
                'last_education_institution' => ($data['last_education_institution']) ? (string) $data['last_education_institution'] : '',
                'skill' => ($data['skill']) ? (string) $data['skill'] : '',
                'notes' => ($data['notes']) ? (string) $data['notes'] : ''
            ];
            DB::table('tbl_user_a_profiles')->where('id', $token_exist->profile_id)->update($param_update_profile);
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update user profile.', 'valid' => true]);
        }
    }

    protected function fn_post_add_group_permission($request) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            $permissions = DB::table('tbl_user_a_permissions')
                    ->where('url', '=', $data['url'])
                    ->where('route', '=', $data['route'])
                    ->where('class', '=', $data['class'])
                    ->where('method', '=', $data['method'])
                    ->where('module_id', '=', $data['module'])
                    ->first();
            if ($permissions == '' || empty($permissions) || $permissions == null) {
                $params = [
                    'url' => ($data['url']) ? (string) $data['url'] : '',
                    'route' => ($data['route']) ? (string) $data['route'] : '',
                    'class' => ($data['class']) ? (string) $data['class'] : '',
                    'method' => ($data['method']) ? (string) $data['method'] : '',
                    'description' => '-',
                    'module_id' => ($data['module']) ? (int) $data['module'] : '',
                    'is_generated_view' => ($data['is_generated_view'] == false) ? 1 : 0,
                    'is_active' => 1,
                    'created_by' => $this->__user_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_date' => date('Y-m-d H:i:s'),
                ];
                $result = DB::table('tbl_user_a_permissions')->insertGetId($params);
                if ($result) {
                    $group_permissions = DB::table('tbl_user_b_group_permissions AS a')->where('a.permission_id', '=', $result)->where('a.group_id', '=', $this->__group_id)->first();
                    if ($group_permissions == '' || empty($group_permissions) || $group_permissions == null) {
                        $param_group_permission = [
                            'group_id' => $this->__group_id,
                            'permission_id' => $result,
                            'is_allowed' => ($data['is_allowed'] == false) ? 1 : 0,
                            'is_public' => ($data['is_public'] == false) ? 1 : 0,
                            'is_active' => 1,
                            'created_by' => $this->__user_id,
                            'created_date' => date('Y-m-d H:i:s'),
                            'updated_date' => date('Y-m-d H:i:s'),
                        ];
                        $result = DB::table('tbl_user_b_group_permissions')->insert($param_group_permission);
                    }
                    if ($data['is_generated_view'] == 1) {
                        
                    }
                    return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update user profile.', 'valid' => true]);
                }
            } else {
                return MyHelper::_set_response('json', ['code' => 500, 'message' => 'Failed insert new permission data exist.', 'valid' => false]);
            }
        }
    }

}
