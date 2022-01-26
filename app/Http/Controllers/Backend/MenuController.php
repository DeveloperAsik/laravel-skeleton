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
use App\Http\Middleware\TokenUser;

/**
 * Description of MenuController
 *
 * @author I00396.ARIF
 */
class MenuController extends Controller {

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
                'title' => 'Menu',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/menu/view'
            ]
        ];
        $module = DB::table('tbl_user_a_modules AS a')->get();
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout', '_breadcrumb', 'module'));
    }

    public function tree_view(Request $request) {
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
                'title' => 'Menu',
                'icon' => '',
                'arrow' => false,
                'path' => config('app.base_extraweb_uri') . '/menu/view'
            ]
        ];
        $module = DB::table('tbl_user_a_modules AS a')->get();
        return view('Public_html.Layouts.Adminlte.index', compact('title_for_layout', '_breadcrumb', 'module'));
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
                $data = DB::table('tbl_menu_a_menus AS a')
                        ->select('a.id', 'a.name', 'a.icon', 'a.path', 'a.badge', 'a.badge_value', 'a.level', 'a.rank', 'a.is_badge', 'a.is_open', 'a.is_active', 'b.id AS module_id', 'b.name AS module_name')
                        ->leftJoin('tbl_user_a_modules AS b', 'b.id', '=', 'a.module_id')
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
                $data = DB::table('tbl_menu_a_menus AS a')
                        ->select('a.id', 'a.name', 'a.icon', 'a.path', 'a.badge', 'a.badge_value', 'a.level', 'a.level', 'a.rank', 'a.is_badge', 'a.is_open', 'a.is_active', 'b.id AS module_id', 'b.name AS module_name')
                        ->leftJoin('tbl_user_a_modules AS b', 'b.id', '=', 'a.module_id')
                        ->orderBy('a.id', 'ASC')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
            }
            $total_rows = DB::table('tbl_menu_a_menus AS a')->count();
            if (isset($data) && !empty($data)) {
                $arr = array();
                foreach ($data AS $keyword => $value) {
                    $is_badge = '';
                    if ($value->is_badge == 1) {
                        $is_badge = ' checked';
                    }
                    $is_open = '';
                    if ($value->is_open == 1) {
                        $is_open = ' checked';
                    }

                    $is_active = '';
                    if ($value->is_active == 1) {
                        $is_active = ' checked';
                    }
                    $arr[] = [
                        'id' => $value->id,
                        'name' => $value->name,
                        'icon' => $value->icon,
                        'badge' => $value->badge,
                        'badge_value' => $value->badge_value,
                        'path' => $value->path,
                        'level' => $value->level,
                        'rank' => $value->rank,
                        'is_badge' => '<input type="checkbox"' . $is_badge . ' name="is_badge" class="make-switch" data-size="small">',
                        'is_open' => '<input type="checkbox"' . $is_open . ' name="is_open" class="make-switch" data-size="small">',
                        'is_active' => '<input type="checkbox"' . $is_active . ' name="is_active" class="make-switch" data-size="small">',
                        'module_id' => $value->module_id,
                        'module_name' => $value->module_name,
                        'action' => '<div class="btn-group">
                        <button type="button" class="btn btn-info"><a href="' . config('app.base_extraweb_uri') . '/menu/remove/' . base64_encode($value->id) . '" style="color:#fff;font-size:14px;" title="Add"><i class="fas fa-plus-circle"></i></a></button>
                        <button type="button" class="btn btn-info"><a href="' . config('app.base_extraweb_uri') . '/menu/delete/' . base64_encode($value->id) . '" style="color:#fff;font-size:14px;" title="Edit"><i class="fas fa-edit"></i></a></button>
                        <button type="button" class="btn btn-info"><a href="' . config('app.base_extraweb_uri') . '/menu/edit/' . base64_encode($value->id) . '" style="color:#fff;font-size:14px;" title="Remove"><i class="far fa-trash-alt"></i></a></button>
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
