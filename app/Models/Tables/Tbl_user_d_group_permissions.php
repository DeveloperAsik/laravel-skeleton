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
 * Description of Tbl_user_d_group_permissions
 *
 * @author elitebook
 */
class Tbl_user_d_group_permissions extends MY_Model {

    //put your code here
    //put your code here  
    public $table_name;

    public function __construct() {
        $this->table_name = 'tbl_user_d_group_permissions';
    }

    public function getCurrentGroup($request, $data) {
        $permissionExist = DB::table($this->table_name)->where([
            ['permission_id', '=', $data->id],
            ['is_active', '=', 1]
        ]);
        $permissionExistTotal = $permissionExist->count();
        if ($permissionExistTotal && $permissionExistTotal == 1) {
            $permissionExistGet = $permissionExist->select('id', 'permission_id', 'group_id', 'is_public', 'is_allowed', 'is_active')->first();
            return $permissionExistGet;
        }else{
            return null;
        }
    }

}
