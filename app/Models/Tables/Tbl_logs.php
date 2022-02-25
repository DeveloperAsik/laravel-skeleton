<?php

namespace App\Models\Tables;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Models\MY_Model;
use Illuminate\Support\Facades\DB;
use App\Helpers\MyHelper;

/**
 * Description of Tbl_logs
 *
 * @author elitebook
 */
class Tbl_logs extends MY_Model {

    //put your code here  
    public static $table_name = "tbl_logs";

    public function __construct() {
        parent::__construct();
    }

    public static function get_list($request) {
        $limit = ($request->limit) ? $request->limit : 10;
        $offset = ($request->offset) ? $request->offset : 0;
        $data = DB::table(self::$table_name . ' AS a')
                ->select('a.id', 'a.fraud_scan', 'a.ip_address', 'a.browser', 'a.class', 'a.method', 'a.event', DB::raw("DATE_FORMAT(a.created_date, '%d %b %Y') as createdDate"), DB::raw("DATE_FORMAT(a.created_date, '%H:%i') as createdDateHour"), 'b.id as user_id', 'b.user_name', 'b.first_name', 'b.last_name', 'b.email')
                ->leftJoin('tbl_user_a_users AS b', 'b.id', '=', 'a.created_by')
                ->offset($offset)
                ->limit($limit)
                ->orderBy('a.id', 'desc')
                ->get();
        if (isset($data) && !empty($data)) {
            $meta = [
                'total' => count($data),
                'offset' => $offset,
                'limit' => $limit,
                'query_param' => $request->getRequestUri()
            ];
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully fetching data', 'valid' => true, 'meta' => $meta, 'data' => $data]);
        } else {
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed fetching data', 'valid' => false, 'data' => null]);
        }
    }

    public static function do_insert($data) {
        $params = [
            'fraud_scan' => ($data['fraud_scan']) ? $data['fraud_scan'] : '',
            'ip_address' => ($data['ip_address']) ? $data['ip_address'] : '',
            'browser' => ($data['browser']) ? $data['browser'] : '',
            'class' => ($data['class']) ? $data['class'] : '',
            'method' => ($data['method']) ? $data['method'] : '',
            'event' => ($data['event']) ? $data['event'] : '',
            'is_active' => ($data['is_active']) ? $data['is_active'] : '',
            'created_by' => ($data['created_by']) ? $data['created_by'] : '',
            'created_date' => ($data['created_date']) ? $data['created_date'] : '',
            'updated_by' => ($data['updated_by']) ? $data['updated_by'] : '',
            'updated_date' => ($data['updated_date']) ? $data['updated_date'] : '',
        ];
        DB::table(self::$table_name)->insert($params);
    }

}
