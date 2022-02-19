<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Tables;

use App\Models\MY_Model;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;

/**
 * Description of Tbl_user_a_permissions
 *
 * @author I00396.ARIF
 */
class Tbl_user_a_modules extends MY_Model {

    //put your code here  
    protected $table_name = 'tbl_user_a_modules';

    public function __construct() {
        parent::__construct();
    }

    public function get_data_by_id($id) {
        $dataExist = DB::table($this->table_name)->where([
            ['id', '=', $id],
            ['is_active', '=', 1]
        ]);
        $dataExistTotal = $dataExist->count();
        if ($dataExistTotal && $dataExistTotal == 1) {
            $dataExistGet = $dataExist->select('id', 'name', 'alias', 'is_active')->first();
            return $dataExistGet;
        } else {
            return null;
        }
    }

    public static function fnGetModules($request) {
        $modules = DB::table('tbl_user_a_modules AS a')->select('*')->get();
        return $modules;
        //return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully fetching modules data.', 'valid' => true, 'data' => $modules]);
    }

}
