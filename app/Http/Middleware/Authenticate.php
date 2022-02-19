<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\TokenUser;
use App\Models\Tables\Tbl_user_d_permissions;
use App\Models\Tables\Tbl_user_d_group_permissions;
use App\Models\Tables\Tbl_user_a_modules;
use Closure;

class Authenticate {

    protected $Tbl_user_d_permissions;
    protected $Tbl_user_d_group_permissions;
    protected $Tbl_user_a_modules;

    public function __construct(Tbl_user_d_permissions $Tbl_user_d_permissions, Tbl_user_d_group_permissions $Tbl_user_d_group_permissions, Tbl_user_a_modules $Tbl_user_a_modules) {
        $this->Tbl_user_d_permissions = $Tbl_user_d_permissions;
        $this->Tbl_user_d_group_permissions = $Tbl_user_d_group_permissions;
        $this->Tbl_user_a_modules = $Tbl_user_a_modules;
    }

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
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $authAccessServices = $this->initServices($request, $currentPath);
        if ($authAccessServices && $authAccessServices['is_valid'] == true) {
            return $next($request);
        } else {
            if ($request->ajax()) {
                $response_data = array('status' => 401, 'message' => 'This url need login session to accessed');
                return response()->json($response_data, 401);
            } else {
                session(['_session_destination_path' => '/' . $currentPath]);
                session()->save();
                return redirect($authAccessServices['url'])->with(['warning-msg' => 'This page need login session, please login first!']);
            }
        }
        //$token = $request->header('Authorization');
        //if (isset($token) && !empty($token)) {
        //    $response = MyHelper::is_jwt_valid($token);
        //    if ($response) {
        //        return $next($request);
        //    } else {
        //        $response_data = array('status' => 401, 'message' => 'Your token is not valid or expired, please re-login or contact administrator', 'data' => array('valid' => false));
        //        return response()->json($response_data, 401);
        //    }
        //} else {
        //    $response_data = array('status' => 401, 'message' => 'Cannot found your token, please re-login or contact administrator', 'data' => array('valid' => false));
        //    return response()->json($response_data, 401);
        //}
    }

    protected function initServices($request, $currentPath) {
        $url = '';
        //get permission by url request from routes
        $currentPermission = $this->Tbl_user_d_permissions->getCurrentPermission($request, $currentPath);
        if ($currentPermission == null) {
            $response = false;
            $url = '/extraweb/login';
        } else {
            //get group and group permissions
            $getGroupUser = $this->Tbl_user_d_group_permissions->getCurrentGroup($request, $currentPermission);
            //get module detail
            $getModule = $this->Tbl_user_a_modules->get_data_by_id($currentPermission->module_id);
            $param = [
                'Permission' => $currentPermission,
                'GroupUser' => $getGroupUser,
                'Module' => $getModule
            ];
            switch ($currentPermission->module_id) {
                case 1:
                    $response = false;
                    break;
                case 2:
                    $response = true;
                    $url = '/';
                    if ($param['GroupUser']->is_public != 1) {
                        $response = false;
                        $url = '/login';
                    }
                    break;
                case 3:
                    $response = true;
                    $url = '/extraweb/login';
                    $data = session()->all();
                    if ($param['GroupUser']->is_public != 1) {
                        $response = false;
                        //check if session is present
                        if (isset($data['_session_is_logged_in']) && !empty($data['_session_is_logged_in']) && $data['_session_is_logged_in'] == true) {
                            $response = true;
                        } else {
                            $response = false;
                            if (isset($data['_session_destination_path']) && !empty($data['_session_destination_path'])) {
                                $url = $data['_session_destination_path'];
                            }
                        }
                    }
                    break;
            }
        }
        $resp = [
            'code' => 200,
            'is_valid' => $response,
            'url' => $url
        ];
        return $resp;
    }

    public static function validate_user($request) {
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

    public static function clear_session() {
        session()->forget('_session_token');
        session()->forget('_session_token_refreshed');
        session()->forget('_session_user_id');
        session()->forget('_session_group_id');
        session()->forget('_session_is_logged_in');
        session()->forget('_session_expiry_date');
        session()->forget('_session_user_name');
        session()->forget('_session_user_email');
        session()->forget('alert-msg');
        session()->flush();
        session()->save();
    }

}
