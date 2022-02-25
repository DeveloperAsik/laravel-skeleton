<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Tables;

use App\Models\MY_Model;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;

/**
 * Description of Tbl_user_a_users
 *
 * @author I00396.ARIF
 */
class Tbl_user_a_users extends MY_Model {

    //put your code here  
    public static $table_name = "tbl_user_a_users";
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password'
    ];

    public function __construct() {
        parent::__construct();
    }

    public static function fnGetUserProfiles($request) {
        $data = $request->session()->all();
        if ($data) {
            $user_profiles = DB::table(self::$table_name . ' AS a')
                            ->select('a.id', 'a.user_name', 'a.first_name', 'a.last_name', 'a.email', 'c.id AS group_id', 'c.name AS group_name', 'e.address', 'e.lat', 'e.lng', 'e.zoom', 'e.facebook', 'e.twitter', 'e.instagram', 'e.linkedin', 'e.img', 'e.last_education', 'e.last_education_institution', 'e.skill', 'e.notes', 'e.description')
                            ->leftJoin('tbl_user_b_user_groups AS b', 'b.user_id', '=', 'a.id')
                            ->leftJoin('tbl_user_a_groups AS c', 'c.id', '=', 'b.group_id')
                            ->leftJoin('tbl_user_c_tokens AS d', 'd.group_id', '=', 'b.group_id')
                            ->leftJoin('tbl_user_a_profiles AS e', 'e.id', '=', 'a.profile_id')
                            ->where('a.id', '=', $data['_session_user_id'])->first();
            $group_permission = DB::table('tbl_user_d_group_permissions AS a')
                            ->select('b.id', 'b.url', 'c.id AS module_id', 'c.name AS module_name', 'b.route_name','b.url', 'b.class', 'b.method')
                            ->leftJoin('tbl_user_d_permissions AS b', 'b.id', '=', 'a.permission_id')
                            ->leftJoin('tbl_user_a_modules AS c', 'b.id', '=', 'b.module_id')
                            ->where('a.group_id', '=', $data['_session_group_id'])->get();
            return MyHelper::array_to_object(['user_profile' => $user_profiles, 'permission' => $group_permission]);
        } else {
            return null;
        }
    }

}
