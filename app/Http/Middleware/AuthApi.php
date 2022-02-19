<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

/**
 * Description of AuthApi
 *
 * @author elitebook
 */
class AuthApi {

    //put your code here
    public static function handle($request, $params = array()) {
        if ($params['GroupUser']->is_public == 1) {
            return true;
        } else {
            
        }
    }

}
