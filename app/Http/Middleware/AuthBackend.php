<?php

namespace App\Http\Middleware;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use Closure;

/**
 * Description of AuthBackend
 *
 * @author I00396.ARIF
 */
class AuthBackend{

    //put your code here
    public function handle(Request $request, Closure $next) {
        $data = $request->session()->all();
        if (isset($data) && !empty($data) && isset($data['_session_is_logged_in'])) {
            if ($data['_session_token'] != null) {
                $is_jwt_valid = MyHelper::is_jwt_valid($data['_session_token']);
                if ($is_jwt_valid == true) {
                    $decode_jwt = MyHelper::decode_jwt($data['_session_token']);
                    if ($data['_session_user_id'] == $decode_jwt->user_id) {
                        return $next($request);
                        //$response_data = array('status' => 200, 'message' => 'Your token is valid', 'data' => array('valid' => true));
                        //return response()->json($response_data, 200);
                    } else {
                        $response_data = array('status' => 500, 'message' => 'Your token is not valid, token user id with session user id not matched!', 'data' => array('valid' => false));
                        return response()->json($response_data, 500);
                    }
                } else {
                    $response_data = array('status' => 500, 'message' => 'Your token is not valid!', 'data' => array('valid' => false));
                    return response()->json($response_data, 500);
                }
            } else {
                $response_data = array('status' => 500, 'message' => 'Your token is not valid, session token is empty!', 'data' => array('valid' => false));
                return response()->json($response_data, 500);
            }
        } else {
            if ($request->ajax()) {
                $response_data = array('status' => 500, 'message' => 'Your is not in login session, session token is empty!', 'data' => array('valid' => false));
                return response()->json($response_data, 500);
            } else {
                $params = [
                    'body' => [
                        'type' => 'status_error_message_box',
                        'message' => 'You are not in logged in session, please login first'
                    ]
                ];
                MyHelper::session_flash_custom($params);
                return redirect('/extraweb/login');
            }
        }
    }

}
