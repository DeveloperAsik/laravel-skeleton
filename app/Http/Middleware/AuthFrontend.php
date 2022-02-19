<?php

namespace App\Http\Middleware;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of AuthFrontend
 *
 * @author I00396.ARIF
 */
class AuthFrontend {

    //put your code here

    public static function handle($request, $params = array()) {
        dd($params);
        $data = $request->session()->all();
        dd($data);
        if (isset($request) && !empty($request)) {
            return $next($request);
        }
    }

}
