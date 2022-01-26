<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use App\Models\MY_Model;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;

/**
 * Description of Tbl_user_a_permissions
 *
 * @author I00396.ARIF
 */
class Tbl_user_a_permissions extends MY_Model {

    //put your code here  
    protected $table_name = 'tbl_user_a_permissions';

    public function __construct() {
        parent::__construct();
    }

    public static function fnGetModules($request) {
        $modules = DB::table('tbl_user_a_modules AS a')->select('a.id', 'a.name', 'a.description')->get();
        return MyHelper::array_to_object($modules);
    }

}
