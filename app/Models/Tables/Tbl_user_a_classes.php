<?php

namespace App\Models\Tables;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Models\MY_Model;

/**
 * Description of Tbl_user_a_classes
 *
 * @author elitebook
 */
class Tbl_user_a_classes extends MY_Model {

    //put your code here  
    public static $table_name = "tbl_user_a_classes";

    public function __construct() {
        parent::__construct();
    }

    public static function do_insert($data) {
        $params = [
            'namespace' => ($data['namespace']) ? $data['namespace'] : '',
            'class' => ($data['class']) ? $data['class'] : '',
            'method' => ($data['method']) ? $data['method'] : '',
            'is_active' => ($data['is_active']) ? $data['is_active'] : '',
            'created_by' => ($data['created_by']) ? $data['created_by'] : '',
            'created_date' => ($data['created_date']) ? $data['created_date'] : '',
            'updated_by' => ($data['updated_by']) ? $data['updated_by'] : '',
            'updated_date' => ($data['updated_date']) ? $data['updated_date'] : '',
        ];
        DB::table(self::$table_name)->insert($params);
    }
   public static function do_update($data) {
        $params = [
            'namespace' => ($data['namespace']) ? $data['namespace'] : '',
            'class' => ($data['class']) ? $data['class'] : '',
            'method' => ($data['method']) ? $data['method'] : '',
            'is_active' => ($data['is_active']) ? $data['is_active'] : '',
            'created_by' => ($data['created_by']) ? $data['created_by'] : '',
            'created_date' => ($data['created_date']) ? $data['created_date'] : '',
            'updated_by' => ($data['updated_by']) ? $data['updated_by'] : '',
            'updated_date' => ($data['updated_date']) ? $data['updated_date'] : '',
        ];
        DB::table(self::$table_name)->where('id', $data['id'])->update($params);
    }
}
