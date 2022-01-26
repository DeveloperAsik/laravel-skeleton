<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\Helpers\MyHelper;
class Authenticate{

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request) {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    public function handle(Request $request, Closure $next) {
        $token = $request->header('Authorization');
        if (isset($token) && !empty($token)) {
            $response = MyHelper::is_jwt_valid($token);
            if ($response) {
                return $next($request);
            } else {
                $response_data = array('status' => 401, 'message' => 'Your token is not valid or expired, please re-login or contact administrator', 'data' => array('valid' => false));
                return response()->json($response_data, 401);
            }
        } else {
            $response_data = array('status' => 401, 'message' => 'Cannot found your token, please re-login or contact administrator', 'data' => array('valid' => false));
            return response()->json($response_data, 401);
        }
    }

}
