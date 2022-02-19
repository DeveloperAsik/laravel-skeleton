<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Tables;

use App\Models\MY_Model;
use Illuminate\Support\Facades\DB;

/**
 * Description of Tbl_user_c_extraweb_sidebars
 *
 * @author I00396.ARIF
 */
class Tbl_user_c_sidebars extends MY_Model {

    //put your code here  
    protected $table_name = 'tbl_user_c_sidebars';

    public function scopeIsOpen($request) {
        $request->where('is_Open', 1);
    }

    public static function get_sidebar_menu($request, $__group_id) {
        //$extraweb_sidebars = DB::table('tbl_user_c_sidebars')->selectRaw('count(level) as total_data, level')->groupBy('level')->get();
        $menu = [];
        $menu_exist_1 = DB::table('tbl_user_c_sidebars AS a')
                ->select('a.id', 'a.title', 'a.path', 'a.icon', 'a.level', 'a.is_badge', 'a.badge', 'a.badge_id', 'a.badge_value', 'a.parent_id', 'a.group_id')
                ->where('a.level', '=', 1)
                ->where('a.group_id', '=', $__group_id)
                ->get();
        if (isset($menu_exist_1) && !empty($menu_exist_1)) {
            foreach ($menu_exist_1 AS $keyword => $value) {
                $menu_exist_2 = DB::table('tbl_user_c_sidebars AS a')
                        ->select('a.id', 'a.title', 'a.path', 'a.icon', 'a.level', 'a.is_badge', 'a.badge', 'a.badge_id', 'a.badge_value', 'a.parent_id', 'a.group_id')
                        ->where('a.level', '=', 2)
                        ->where('a.parent_id', '=', $value->id)
                        ->where('a.group_id', '=', $__group_id)
                        ->get();
                $menu2 = [];
                if (isset($menu_exist_2) && !empty($menu_exist_2)) {
                    foreach ($menu_exist_2 AS $key => $val) {
                        $menu_exist_3 = DB::table('tbl_user_c_sidebars AS a')
                                ->select('a.id', 'a.title', 'a.path', 'a.icon', 'a.level', 'a.is_badge', 'a.badge', 'a.badge_id', 'a.badge_value', 'a.parent_id', 'a.group_id')
                                ->where('a.level', '=', 3)
                                ->where('a.parent_id', '=', $val->id)
                                ->where('a.group_id', '=', $__group_id)
                                ->get();
                        $menu3 = [];
                        if (isset($menu_exist_3) && !empty($menu_exist_3)) {
                            foreach ($menu_exist_3 AS $k => $v) {
                                $menu_exist_4 = DB::table('tbl_user_c_sidebars AS a')
                                        ->select('a.id', 'a.title', 'a.path', 'a.icon', 'a.level', 'a.is_badge', 'a.badge', 'a.badge_id', 'a.badge_value', 'a.parent_id', 'a.group_id')
                                        ->where('a.level', '=', 3)
                                        ->where('a.parent_id', '=', $v->id)
                                        ->where('a.group_id', '=', $__group_id)
                                        ->get();
                                $menu4 = [];
                                if (isset($menu_exist_4) && !empty($menu_exist_4)) {
                                    foreach ($menu_exist_4 AS $l => $w) {
                                        $menu4[] = [
                                            "id" => $w->id,
                                            "title" => $w->title,
                                            "path" => $w->path,
                                            "icon" => $w->icon,
                                            "level" => $w->level,
                                            "is_badge" => $w->is_badge,
                                            "badge" => $w->badge,
                                            "badge_id" => $w->badge_id,
                                            "badge_value" => $w->badge_value,
                                            "parent_id" => $w->parent_id,
                                            "group_id" => $w->group_id,
                                            "child" => []
                                        ];
                                    }
                                }
                                $menu3[] = [
                                    "id" => $v->id,
                                    "title" => $v->title,
                                    "path" => $v->path,
                                    "icon" => $v->icon,
                                    "level" => $v->level,
                                    "is_badge" => $v->is_badge,
                                    "badge" => $v->badge,
                                    "badge_id" => $v->badge_id,
                                    "badge_value" => $v->badge_value,
                                    "parent_id" => $v->parent_id,
                                    "group_id" => $v->group_id,
                                    "child" => $menu4
                                ];
                            }
                        }
                        $menu2[] = [
                            "id" => $val->id,
                            "title" => $val->title,
                            "path" => $val->path,
                            "icon" => $val->icon,
                            "level" => $val->level,
                            "is_badge" => $val->is_badge,
                            "badge" => $val->badge,
                            "badge_id" => $val->badge_id,
                            "badge_value" => $val->badge_value,
                            "parent_id" => $val->parent_id,
                            "group_id" => $val->group_id,
                            "child" => $menu3
                        ];
                    }
                }
                $menu[] = [
                    "id" => $value->id,
                    "title" => $value->title,
                    "path" => $value->path,
                    "icon" => $value->icon,
                    "level" => $value->level,
                    "is_badge" => $value->is_badge,
                    "badge" => $value->badge,
                    "badge_id" => $value->badge_id,
                    "badge_value" => $value->badge_value,
                    "parent_id" => $value->parent_id,
                    "group_id" => $value->group_id,
                    "child" => $menu2
                ];
            }
        }
        return $menu;
    }

    public static function get_menus($module_id, $level, $parent_id) {
        return DB::table('tbl_user_c_sidebars AS a')
                        ->select('a.id', 'a.title', 'a.icon', 'a.path', 'a.badge', 'a.badge_value', 'a.level', 'a.level', 'a.rank', 'a.parent_id', 'a.is_badge', 'a.is_open', 'a.is_active', 'b.id AS module_id', 'b.name AS module_name')
                        ->leftJoin('tbl_user_a_modules AS b', 'b.id', '=', 'a.module_id')
                        ->where('a.module_id', '=', $module_id)
                        ->where('a.level', '=', $level)
                        ->where('a.parent_id', '=', $parent_id)
                        ->orderBy('a.rank', 'ASC')
                        ->get();
    }

    public static function get_menu_by_id($id, $level, $parent_id) {
        return DB::table('tbl_user_c_sidebars AS a')
                        ->select('a.id', 'a.title', 'a.icon', 'a.path', 'a.badge', 'a.badge_value', 'a.level', 'a.level', 'a.rank', 'a.parent_id', 'a.is_badge', 'a.is_open', 'a.is_active', 'b.id AS module_id', 'b.name AS module_name')
                        ->leftJoin('tbl_user_a_modules AS b', 'b.id', '=', 'a.module_id')
                        ->where('a.id', '=', $id)
                        ->orderBy('a.rank', 'ASC')
                        ->get();
    }

}
