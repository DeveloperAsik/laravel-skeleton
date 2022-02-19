<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Tables;

use App\MY_Model;

/**
 * Description of Tbl_user_c_tokens
 *
 * @author I00396.ARIF
 */
class Tbl_user_c_tokens extends MY_Model {

    //put your code here  
    protected $table_name = 'tbl_user_c_tokens';

    public function __construct() {
        parent::__construct();
    }

    public function scopeIsLoggedIn($request) {
        $request->where('is_logged_in', 1);
    }

    public function scopeIsNotLoggedIn($request) {
        $request->where('is_logged_in', 0);
    }

    public function scopeIsExpiry($request) {
        $request->where('is_expiry', 1);
    }

    public function scopeIsNotExpiry($request) {
        $request->where('is_expiry', 0);
    }

}
