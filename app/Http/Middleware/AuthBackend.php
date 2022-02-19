<?php

namespace App\Http\Middleware;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of AuthBackend
 *
 * @author I00396.ARIF
 */
class AuthBackend {

    //put your code here
    public static function handle($request, $params = array()) {
        $response = true;
        if($params['GroupUser']->is_public != 1){
            $response = false;
        }
        return $response;
    }

}
