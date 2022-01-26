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
class GroupPermissionController extends Controller {

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
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout', '_breadcrumb'));
    }

    public function get_list(Request $request) {
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
                        ->select('a.id', 'b.url', 'c.id AS module_id', 'c.name AS module_name', 'b.route', 'b.class', 'b.method', 'b.description', 'b.is_generated_view', 'd.id AS group_id', 'd.name AS group_name')
                        ->leftJoin('tbl_user_a_permissions AS b', 'b.id', '=', 'a.permission_id')
                        ->leftJoin('tbl_user_a_modules AS c', 'c.id', '=', 'b.module_id')
                        ->leftJoin('tbl_user_a_groups AS d', 'd.id', '=', 'a.group_id')
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
                        ->select('a.id', 'b.url', 'c.id AS module_id', 'c.name AS module_name', 'b.route', 'b.class', 'b.method', 'b.description', 'b.is_generated_view', 'd.id AS group_id', 'd.name AS group_name')
                        ->leftJoin('tbl_user_a_permissions AS b', 'b.id', '=', 'a.permission_id')
                        ->leftJoin('tbl_user_a_modules AS c', 'c.id', '=', 'b.module_id')
                        ->leftJoin('tbl_user_a_groups AS d', 'd.id', '=', 'a.group_id')
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
                    $is_hook = '';
                    if ($value->group_id == $this->__group_id) {
                        $is_hook = ' checked';
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
                        'is_hook' => '<input type="checkbox"' . $is_hook . ' name="is_hook" class="make-switch" data-size="small">',
                        'is_generated_view' => '<input type="checkbox"' . $generated_view . ' name="is_generated_view" class="make-switch" data-size="small">',
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
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout', '_breadcrumb', 'modules'));
    }

}
