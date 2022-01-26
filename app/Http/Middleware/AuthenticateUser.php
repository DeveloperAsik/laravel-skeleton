<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\TokenUser;

/**
 * Description of Validate
 *
 * @author I00396.ARIF
 */
class AuthenticateUser {

    //put your code here

    public static function run($request) {
        if (isset($request) && !empty($request)) {
            $user = DB::table('tbl_user_a_users AS a')->select('a.id', 'a.user_name', 'a.email', 'a.password')->where('a.email', 'like', '%' . $request['userid'] . '%')->first();
            if (isset($user) && !empty($user)) {
                $verify_hash = TokenUser::__verify_hash(base64_decode($request['password']), $user->password);
                if ($verify_hash == true) {
                    $code = 200;
                    $msg = 'Successfully generate token user';
                    $valid = true;
                    $generate_token = TokenUser::__generate_token($request, $user);
                } else {
                    $code = 200;
                    $msg = 'Failed generate token user';
                    $valid = false;
                    $generate_token = null;
                }
                return MyHelper::_set_response('json', ['code' => $code, 'message' => $msg, 'valid' => $valid, 'meta' => [], 'data' => ['token' => $generate_token]]);
            }
        }
    }

    public static function save_token($request) {
        if (isset($request) && !empty($request)) {
            $token = $request['token']['token'];
            $token_refresh = $request['token']['token_refresh'];
            $decode_jwt = MyHelper::decode_jwt($token);
            //session()->put();
            session(['_session_token' => $token]);
            session(['_session_token_refreshed' => $token_refresh]);
            session(['_session_user_id' => $decode_jwt->user_id]);
            session(['_session_group_id' => $decode_jwt->group_id]);
            session(['_session_user_name' => $decode_jwt->user_name]);
            session(['_session_user_email' => $decode_jwt->user_email]);
            session(['_session_is_logged_in' => true]);
            session(['_session_expiry_date' => date('Y-m-d H:i:s', strtotime('+24 Hours'))]);
            session()->save();
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully save token.', 'valid' => true]);
        }
    }

}
