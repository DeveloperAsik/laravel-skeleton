<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

/**
 * Description of AuthFrontend
 *
 * @author I00396.ARIF
 */
class AuthFrontend extends Middleware {

    //put your code here

    public function handle(Request $request, Closure $next) {
        $data = $request->session()->all();
        dd($data);
        if (isset($request) && !empty($request)) {
            return $next($request);
        }
    }

}
