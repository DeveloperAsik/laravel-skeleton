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
use App\Models\Tables\Tbl_user_c_sidebars;

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
            $menu = Tbl_user_c_sidebars::get_menu_by_id($request->id, 1, 0);
        }
        return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully fetching menu data.', 'valid' => true, 'data' => $menu]);
    }

    protected function fn_get_menu($request) {
        $menu = [];
        if ($request->module_id) {
            $menu_1 = Tbl_user_c_sidebars::get_menus($request->module_id, 1, 0);
            if ($menu_1) {
                foreach ($menu_1 AS $keyword => $value) {
                    $menu_2 = Tbl_user_c_sidebars::get_menus($request->module_id, ($value->level + 1), $value->id);
                    $arr_menu_2 = [];
                    if ($menu_2) {
                        foreach ($menu_2 AS $key => $val) {
                            $menu_3 = Tbl_user_c_sidebars::get_menus($request->module_id, ($val->level + 1), $val->id);
                            $arr_menu_3 = [];
                            if ($menu_3) {
                                foreach ($menu_3 AS $ky => $vl) {
                                    $menu_4 = Tbl_user_c_sidebars::get_menus($request->module_id, ($vl->level + 1), $vl->id);
                                    $arr_menu_4 = [];
                                    if ($menu_4) {
                                        foreach ($menu_4 AS $k => $v) {
                                            $arr_menu_4[] = [
                                                "id" => $v->id,
                                                "parent" => $v->parent_id,
                                                "text" => '<button type="button" style="background-color: transparent;border: none;" data-toggle="modal" data-target="#modal_edit_node" data-level="4"  data-id="' . $v->id . '">' . $v->title . '</button>',
                                                "icon" => $v->icon
                                            ];
                                        }
                                    }
                                    $arr_menu_3[] = [
                                        "id" => $vl->id,
                                        "parent" => $vl->parent_id,
                                        "text" => '<button type="button" style="background-color: transparent;border: none;" data-toggle="modal" data-target="#modal_edit_node" data-level="3"  data-id="' . $vl->id . '">' . $vl->title . '</button>',
                                        "icon" => $vl->icon,
                                        "children" => $arr_menu_4
                                    ];
                                }
                            }
                            $arr_menu_2[] = [
                                "id" => $val->id,
                                "parent" => $val->parent_id,
                                "text" => '<button type="button" style="background-color: transparent;border: none;" data-toggle="modal" data-target="#modal_edit_node" data-level="2"  data-id="' . $val->id . '">' . $val->title . '</button>',
                                "icon" => $val->icon,
                                "children" => $arr_menu_3
                            ];
                        }
                    }
                    $menu[] = [
                        "id" => $value->id,
                        "parent" => $value->parent_id,
                        "text" => '<button type="button" style="background-color: transparent;border: none;" data-toggle="modal" data-target="#modal_edit_node" data-level="1" data-id="' . $value->id . '">' . $value->title . '</button>',
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
            case "get-group-permission-list":
                $response = $this->fn_post_get_group_permission_list($request);
                break;
            case "get-user-list":
                $response = $this->fn_get_user_list($request);
                break;
            case "get-permission-list":
                $response = $this->fn_get_permission_list($request);
                break;
            case "get-group-list":
                $response = $this->fn_get_group_list($request);
                break;
            case "get-group-permission-list":
                $response = $this->fn_get_group_permission_list($request);
                break;
        }
        return $response;
    }

    protected function fn_get_group_permission_list(Request $request) {
        if (isset($request) && !empty($request)) {
            $draw = $request['draw'];
            $limit = ($request->length) ? $request->length : 10;
            $offset = ($request->start) ? $request->start : 0;
            $search = $request['search']['value'];
            if (isset($search) && !empty($search)) {
                $data = DB::table('tbl_user_d_group_permissions AS a')
                        ->select('a.*', 'b.id permission_id', 'b.route_name', 'b.url', 'b.class', 'b.method', 'b.is_allowed as permission_is_allowed', 'b.is_active as permission_is_active', 'c.id as group_id', 'c.name as group_name')
                        ->leftJoin('tbl_user_d_permissions AS b', 'b.id', '=', 'a.permission_id')
                        ->leftJoin('tbl_user_a_groups AS d', 'd.id', '=', 'a.group_id')
                        ->where('b.route_name', 'like', '%' . $search . '%')
                        ->orWhere('b.url', 'like', '%' . $search . '%')
                        ->orWhere('b.class', 'like', '%' . $search . '%')
                        ->orWhere('b.method', 'like', '%' . $search . '%')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            } else {
                $data = DB::table('tbl_user_d_group_permissions AS a')
                        ->select('a.*', 'b.id permission_id', 'b.route_name', 'b.url', 'b.class', 'b.method', 'b.is_allowed as permission_is_allowed', 'b.is_active as permission_is_active', 'c.id as group_id', 'c.name as group_name')
                        ->leftJoin('tbl_user_d_permissions AS b', 'b.id', '=', 'a.permission_id')
                        ->leftJoin('tbl_user_a_groups AS d', 'd.id', '=', 'a.group_id')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            }
            $total_rows = DB::table('tbl_user_d_group_permissions AS a')->count();
            if (isset($data) && !empty($data)) {
                $arr = array();
                foreach ($data AS $keyword => $value) {
                    $is_allowed = '';
                    if ($value->is_allowed == 1) {
                        $is_allowed = ' checked';
                    }
                    $is_active = '';
                    if ($value->is_active == 1) {
                        $is_active = ' checked';
                    }
                    $arr[] = [
                        'id' => $value->id,
                        'route_name' => $value->url,
                        'url' => $value->module_name,
                        'class' => $value->route,
                        'method' => $value->method,
                        'is_allowed' => $is_allowed,
                        'is_active' => $is_active,
                        'action' => '<div class="btn-group">
                        <button type="button" class="btn btn-info"><a href="' . config('app.base_extraweb_uri') . '/profile/hook/off/' . base64_encode($value->id) . '" style="color:#fff;font-size:14px;" title="Remove from group access"><i class="far fa-trash-alt"></i></a></button>
                        <button type="button" class="btn btn-info"><a href="' . config('app.base_extraweb_uri') . '/profile/hook/on/' . base64_encode($value->id) . '" style="color:#fff;font-size:14px;" title="Add for group access"><i class="fas fa-plus-circle"></i></a></button>
                        <button type="button" class="btn btn-info"><a href="' . config('app.base_extraweb_uri') . '/permission/edit/' . base64_encode($value->id) . '" style="color:#fff;font-size:14px;" title="Edit group access"><i class="fas fa-edit"></i></a></button>
                      </div>',
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

    protected function fn_get_group_list($request) {
        if (isset($request) && !empty($request)) {
            $draw = $request['draw'];
            $limit = ($request->length) ? $request->length : 10;
            $offset = ($request->start) ? $request->start : 0;
            $search = $request['search']['value'];
            if (isset($search) && !empty($search)) {
                $data = DB::table('tbl_user_a_groups AS a')
                        ->select('a.*')
                        ->where('a.name', 'like', '%' . $search . '%')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            } else {
                $data = DB::table('tbl_user_a_groups AS a')
                        ->select('a.*')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            }
            $total_rows = DB::table('tbl_user_a_groups AS a')->count();
            if (isset($data) && !empty($data)) {
                $arr = array();
                foreach ($data AS $keyword => $value) {
                    $is_active = '';
                    if ($value->is_active == 1) {
                        $is_active = ' checked';
                    }
                    $arr[] = [
                        'id' => $value->id,
                        'name' => $value->name,
                        'description' => $value->description,
                        'is_active' => '<input type="checkbox"' . $is_active . ' name="is_active" class="make-switch" data-size="small">',
                        'action' => '<a href="">edit</a> | <a href="">delete</a> | <a href="">remove</a>'
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

    protected function fn_get_permission_list($request) {
        if (isset($request) && !empty($request)) {
            $draw = $request['draw'];
            $limit = ($request->length) ? $request->length : 10;
            $offset = ($request->start) ? $request->start : 0;
            $search = $request['search']['value'];
            if (isset($search) && !empty($search)) {
                $data = DB::table('tbl_user_d_permissions AS a')
                        ->select('a.id', 'a.route_name', 'a.url', 'a.class', 'a.method', 'a.is_active', 'b.id AS module_id', 'b.name AS module_name', 'b.alias AS module_alias')
                        ->leftJoin('tbl_user_a_modules AS b', 'b.id', '=', 'a.module_id')
                        ->where('a.route_name', 'like', '%' . $search . '%')
                        ->orWhere('a.url', 'like', '%' . $search . '%')
                        ->orWhere('a.class', 'like', '%' . $search . '%')
                        ->orWhere('a.method', 'like', '%' . $search . '%')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            } else {
                $data = DB::table('tbl_user_d_permissions AS a')
                        ->select('a.id', 'a.route_name', 'a.url', 'a.class', 'a.method', 'a.is_active', 'b.id AS module_id', 'b.name AS module_name', 'b.alias AS module_alias')
                        ->leftJoin('tbl_user_a_modules AS b', 'b.id', '=', 'a.module_id')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            }
            $total_rows = DB::table('tbl_user_d_permissions AS a')->count();
            if (isset($data) && !empty($data)) {
                $arr = array();
                foreach ($data AS $keyword => $value) {
                    $is_active = '';
                    $is_active_value = 0;
                    if ($value->is_active == 1) {
                        $is_active = ' checked';
                        $is_active_value = 1;
                    }
                    $arr[] = [
                        'id' => $value->id,
                        'route_name' => $value->route_name,
                        'url' => $value->url,
                        'class' => $value->class,
                        'method' => $value->method,
                        'module_id' => $value->module_id,
                        'module_name' => $value->module_name,
                        'is_active' => '<input type="checkbox"' . $is_active . ' value="' . $is_active_value . '" name="is_active" class="make-switch" data-size="small" data-id="' . $value->id . '">',
                        'action' => '<a href="/extraweb/permission/edit/' . $value->id . '">edit</a>'
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

    protected function fn_get_user_list($request) {
        if (isset($request) && !empty($request)) {
            $draw = $request['draw'];
            $limit = ($request->length) ? $request->length : 10;
            $offset = ($request->start) ? $request->start : 0;
            $search = $request['search']['value'];
            if (isset($search) && !empty($search)) {
                $data = DB::table('tbl_user_a_users AS a')
                        ->select('a.*', 'c.id as group_id', 'c.name as group_name')
                        ->leftJoin('tbl_user_b_user_groups AS b', 'b.user_id', '=', 'a.id')
                        ->leftJoin('tbl_user_a_groups AS c', 'c.id', '=', 'b.group_id')
                        ->where('a.code', 'like', '%' . $search . '%')
                        ->orWhere('a.user_name', 'like', '%' . $search . '%')
                        ->orWhere('a.first_name', 'like', '%' . $search . '%')
                        ->orWhere('a.last_name', 'like', '%' . $search . '%')
                        ->orWhere('a.email', 'like', '%' . $search . '%')
                        ->orWhere('c.name', 'like', '%' . $search . '%')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            } else {
                $data = DB::table('tbl_user_a_users AS a')
                        ->select('a.*', 'c.id as group_id', 'c.name as group_name')
                        ->leftJoin('tbl_user_b_user_groups AS b', 'b.user_id', '=', 'a.id')
                        ->leftJoin('tbl_user_a_groups AS c', 'c.id', '=', 'b.group_id')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            }
            $total_rows = DB::table('tbl_user_a_users AS a')->count();
            if (isset($data) && !empty($data)) {
                $arr = array();
                foreach ($data AS $keyword => $value) {
                    $is_active = '';
                    if ($value->is_active == 1) {
                        $is_active = ' checked';
                    }
                    $arr[] = [
                        'id' => $value->id,
                        'code' => $value->code,
                        'user_name' => $value->user_name,
                        'first_name' => $value->first_name,
                        'last_name' => $value->last_name,
                        'email' => $value->email,
                        'group_id' => $value->group_id,
                        'group_name' => $value->group_name,
                        'is_active' => '<input type="checkbox"' . $is_active . ' name="is_active" class="make-switch" data-size="small">',
                        'action' => '<a href="">edit</a> | <a href="">delete</a> | <a href="">remove</a>'
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

    public function fn_post_update_menu(Request $request) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            if ($data['parent'] && $data['parent'] == 'root') {
                $parent_id = 0;
                $level = 1;
                $exist_all = DB::table('tbl_user_c_sidebars AS a')->select('*')->where('a.module_id', '=', $data['module_id'])->where('a.level', '=', $level)->where('a.parent_id', '=', $parent_id)->get();
                $total_exist = count($exist_all);
                $rank = $total_exist + 1;
            } else {
                $parent_id = (int) $data['parent'];
                $parent = DB::table('tbl_user_c_sidebars AS a')->select('*')->where('a.id', '=', $parent_id)->first();
                $members = DB::table('tbl_user_c_sidebars AS a')->select('*')->where('a.parent_id', '=', $parent_id)->get();
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
                    'title' => (string) $data['value'],
                    'icon' => '',
                    'path' => '',
                    'level' => $level,
                    'rank' => $rank,
                    'parent_id' => $parent_id,
                    'group_id' => $this->__group_id,
                    'is_badge' => 0,
                    'is_open' => 0,
                    'is_active' => 1,
                    'module_id' => (int) $data['module_id'],
                    'created_by' => $this->__user_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->__user_id,
                    'updated_date' => date('Y-m-d H:i:s'),
                ];
                $response = DB::table('tbl_user_c_sidebars')->insert($param);
            } else {
                $param = [
                    'title' => (string) $data['title'],
                    'icon' => $data['icon'],
                    'path' => $data['path'],
                    'level' => (int) $data['level'],
                    'rank' => (int) $data['rank'],
                    'parent_id' => (int) $data['parent'],
                    'group_id' => $this->__group_id,
                    'is_badge' => (int) $data['is_badge'],
                    'is_open' => (int) $data['is_open'],
                    'is_active' => (int) $data['is_active'],
                    'updated_by' => $this->__user_id,
                    'updated_date' => date('Y-m-d H:i:s'),
                ];
                $response = DB::table('tbl_user_c_sidebars')->where('id', '=', (int) $data['id'])->update($param);
            }
            if ($response) {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update menu.', 'valid' => true]);
            } else {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully update menu.', 'valid' => false]);
            }
        }
    }

    public function fn_post_get_group_permission_list($request) {
        if (isset($request) && !empty($request)) {
            $draw = $request['draw'];
            $limit = ($request->length) ? $request->length : 10;
            $offset = ($request->start) ? $request->start : 0;
            $search = $request['search']['value'];
            if (isset($search) && !empty($search)) {
                $data = DB::table('tbl_user_d_group_permissions AS a')
                        ->select('a.id', 'a.permission_id', 'a.group_id', 'a.is_allowed', 'a.is_public', 'a.is_active', 'b.route_name', 'b.url', 'b.class', 'b.method', 'b.is_active as permission_is_active', 'c.id AS group_id', 'c.name AS group_name')
                        ->leftJoin('tbl_user_d_permissions AS b', 'b.id', '=', 'a.permission_id')
                        ->leftJoin('tbl_user_a_groups AS c', 'c.id', '=', 'a.group_id')
                        ->orWhere('b.route_name', 'like', '%' . $search . '%')
                        ->orWhere('b.url', 'like', '%' . $search . '%')
                        ->orWhere('b.class', 'like', '%' . $search . '%')
                        ->orWhere('b.method', 'like', '%' . $search . '%')
                        ->orWhere('d.group_name', 'like', '%' . $search . '%')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            } else {
                $data = DB::table('tbl_user_d_group_permissions AS a')
                        ->select('a.id', 'a.permission_id', 'a.group_id', 'a.is_allowed', 'a.is_public', 'a.is_active', 'b.route_name', 'b.url', 'b.class', 'b.method', 'b.is_active as permission_is_active', 'c.id AS group_id', 'c.name AS group_name')
                        ->leftJoin('tbl_user_d_permissions AS b', 'b.id', '=', 'a.permission_id')
                        ->leftJoin('tbl_user_a_groups AS c', 'c.id', '=', 'a.group_id')
                        ->where('a.group_id', '=', $this->__group_id)
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            }
            $total_rows = DB::table('tbl_user_d_group_permissions AS a')->count();
            if (isset($data) && !empty($data)) {
                $arr = array();
                foreach ($data AS $keyword => $value) {
                    $is_public = '';
                    if ($value->is_public == 1) {
                        $is_public = ' checked';
                    }
                    $is_allowed = '';
                    if ($value->is_allowed == 1) {
                        $is_allowed = ' checked';
                    }
                    $is_active = '';
                    if ($value->is_active == 1) {
                        $is_active = ' checked';
                    }
                    $arr[] = [
                        'id' => $value->id,
                        'url' => $value->url,
                        'route_name' => $value->route_name,
                        'class' => $value->class,
                        'method' => $value->method,
                        'group_id' => $value->group_id,
                        'group_name' => $value->group_name,
                        'is_public' => '<input type="checkbox"' . $is_public . ' name="is_public" class="make-switch" data-size="small">',
                        'is_allowed' => '<input type="checkbox"' . $is_allowed . ' name="is_allowed" class="make-switch" data-size="small">',
                        'is_active' => '<input type="checkbox"' . $is_active . ' name="is_active" class="make-switch" data-size="small">',
                        'action' => '<a href="">Edit</a> | <a href="">Delete</a>'
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
                    $group_permissions = DB::table('tbl_user_d_group_permissions AS a')->where('a.permission_id', '=', $result)->where('a.group_id', '=', $this->__group_id)->first();
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
                        $result = DB::table('tbl_user_d_group_permissions')->insert($param_group_permission);
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
