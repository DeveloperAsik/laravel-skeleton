<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

/**
 * Description of ShippingVendorController
 *
 * @author I00396.ARIF
 */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;

class ShippingVendorController extends Controller {

    //put your code here

    public function get_list(Request $request) {
        $limit = ($request->limit) ? $request->limit : 10;
        $offset = ($request->offset) ? $request->offset : 0;
        $data = DB::table('tbl_d_shipping_vendors AS a')
                ->select('a.id', 'a.code', 'a.name', 'a.address', 'a.email', 'a.phone_number', 'a.fax_number', 'a.is_active', 'a.created_date')
                ->offset($offset)
                ->limit($limit)
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

}
