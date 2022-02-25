<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Tables;

use App\MY_Model;

/**
 * Description of Tbl_user_a_devices
 *
 * @author I00396.ARIF
 */
class Tbl_user_a_devices extends MY_Model {

    //put your code here  
    public static $table_name = "tbl_user_a_devices";

    public function __construct() {
        parent::__construct();
    }

    public function scopeIsMobile($request) {
        $request->where('is_expiry', 1);
    }

    public function scopeIsNotMobile($request) {
        $request->where('is_expiry', 0);
    }

    public function scopeIsTablet($request) {
        $request->where('is_expiry', 1);
    }

    public function scopeIsNotTablet($request) {
        $request->where('is_expiry', 0);
    }
}
