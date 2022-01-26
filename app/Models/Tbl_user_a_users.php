<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

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
    protected $table_name = 'tbl_user_a_users';
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
            $user_profiles = DB::table('tbl_user_a_users AS a')
                            ->select('a.id', 'a.user_name', 'a.first_name', 'a.last_name', 'a.email', 'c.id AS group_id', 'c.name AS group_name', 'e.address', 'e.lat', 'e.lng', 'e.zoom', 'e.facebook', 'e.twitter', 'e.instagram', 'e.linkedin', 'e.img', 'e.last_education', 'e.last_education_institution', 'e.skill', 'e.notes', 'e.description')
                            ->leftJoin('tbl_user_b_user_groups AS b', 'b.user_id', '=', 'a.id')
                            ->leftJoin('tbl_user_a_groups AS c', 'c.id', '=', 'b.group_id')
                            ->leftJoin('tbl_user_c_tokens AS d', 'd.group_id', '=', 'b.group_id')
                            ->leftJoin('tbl_user_a_profiles AS e', 'e.id', '=', 'd.profile_id')
                            ->where('a.id', '=', $data['_session_user_id'])->first();
            $group_permission = DB::table('tbl_user_b_group_permissions AS a')
                            ->select('b.id', 'b.url', 'c.id AS module_id', 'c.name AS module_name', 'b.route', 'b.class', 'b.method', 'b.description', 'b.is_generated_view')
                            ->leftJoin('tbl_user_a_permissions AS b', 'b.id', '=', 'a.permission_id')
                            ->leftJoin('tbl_user_a_modules AS c', 'b.id', '=', 'b.module_id')
                            ->where('a.group_id', '=', $data['_session_group_id'])->get();
            return MyHelper::array_to_object(['user_profile' => $user_profiles, 'permission' => $group_permission]);
        } else {
            return null;
        }
    }

}
