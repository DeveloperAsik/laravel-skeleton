<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use App\Models\MY_Model;
use Illuminate\Support\Facades\DB;

/**
 * Description of Tbl_menu_a_menus
 *
 * @author I00396.ARIF
 */
class Tbl_menu_a_menus extends MY_Model {

    //put your code here  
    protected $table_name = 'tbl_menu_a_menus';

    public function __construct() {
        parent::__construct();
    }

    public static function get_menus($module_id, $level, $parent_id) {
        return DB::table('tbl_menu_a_menus AS a')
                        ->select('a.id', 'a.name', 'a.icon', 'a.path', 'a.badge', 'a.badge_value', 'a.level', 'a.level', 'a.rank', 'a.parent_id', 'a.is_badge', 'a.is_open', 'a.is_active', 'b.id AS module_id', 'b.name AS module_name')
                        ->leftJoin('tbl_user_a_modules AS b', 'b.id', '=', 'a.module_id')
                        ->where('a.module_id', '=', $module_id)
                        ->where('a.level', '=', $level)
                        ->where('a.parent_id', '=', $parent_id)
                        ->orderBy('a.rank', 'ASC')
                        ->get();
    }

    public static function get_menu_by_id($id, $level, $parent_id) {
        return DB::table('tbl_menu_a_menus AS a')
                        ->select('a.id', 'a.name', 'a.icon', 'a.path', 'a.badge', 'a.badge_value', 'a.level', 'a.level', 'a.rank', 'a.parent_id', 'a.is_badge', 'a.is_open', 'a.is_active', 'b.id AS module_id', 'b.name AS module_name')
                        ->leftJoin('tbl_user_a_modules AS b', 'b.id', '=', 'a.module_id')
                        ->where('a.id', '=', $id)
                        ->orderBy('a.rank', 'ASC')
                        ->get();
    }

}
