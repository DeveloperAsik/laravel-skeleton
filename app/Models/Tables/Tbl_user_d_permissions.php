<?php

namespace App\Models\Tables;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Models\MY_Model;
use Illuminate\Support\Facades\DB;

/**
 * Description of Tbl_user_d_permissions
 *
 * @author elitebook
 */
class Tbl_user_d_permissions extends MY_Model {

    //put your code here  
    public $table_name;

    public function __construct() {
        $this->table_name = 'tbl_user_d_permissions';
    }

    public function getCurrentPermission($request, $path) {
        $permissionExist = DB::table($this->table_name)->where('url', '=', $path);
        $permissionExistTotal = $permissionExist->count();
        if ($permissionExistTotal && $permissionExistTotal == 1) {
            $permissionExistGet = $permissionExist->select('id', 'route_name', 'url', 'class', 'method', 'module_id', 'is_active')->first();
            return $permissionExistGet;
        } else {
            return null;
        }
    }

}
