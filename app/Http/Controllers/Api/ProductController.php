<?php

namespace App\Http\Controllers\Api;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;

/**

  /**
 * Description of ProductController
 *
 * @author I00396.ARIF
 */
class ProductController extends Controller {

    //put your code here
    public function get_list(Request $request) {
        $limit = ($request->limit) ? $request->limit : 10;
        $offset = ($request->offset) ? $request->offset : 0;
        $data = DB::table('tbl_b_products AS a')
                ->select('a.id','a.name','a.base_price','a.description','a.is_active','a.created_date','b.id AS brand_id','b.name AS brand_name')
                ->leftJoin('tbl_b_brands AS b', 'b.id', '=', 'a.brand_id')
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

    public function get_stock_list(Request $request) {
        $limit = ($request->limit) ? $request->limit : 10;
        $offset = ($request->offset) ? $request->offset : 0;
        $data = DB::table('tbl_b_product_stocks AS a')
                ->select('a.id', 'a.sku', 'a.stock_end AS stock', 'a.price_off', 'a.price_on', 'a.weight', 'a.length', 'a.width', 'b.id AS product_id', 'b.name AS product_name', 'b.base_price', 'c.id AS color_id', '.c.name AS color_name', 'd.id AS size_id', 'd.name AS size_name', 'e.id AS image_id', 'e.path_48', 'e.path_128', 'e.path_640', 'e.path_1024', 'e.path_original', 'f.id AS category_id', 'f.name AS category_name', 'g.id AS gender_id', 'g.name AS gender_name')
                ->leftJoin('tbl_b_products AS b', 'b.id', '=', 'a.product_id')
                ->leftJoin('tbl_b_colors AS c', 'c.id', '=', 'a.color_id')
                ->leftJoin('tbl_b_sizes AS d', 'd.id', '=', 'a.size_id')
                ->leftJoin('tbl_b_images AS e', 'e.id', '=', 'a.image_id')
                ->leftJoin('tbl_b_categories AS f', 'f.id', '=', 'a.category_id')
                ->leftJoin('tbl_b_genders AS g', 'g.id', '=', 'a.gender_id')
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

    public function insert(Request $request) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            $response_msg = '';
            if (!$data['name'] || $data['name'] == '') {
                $response_msg .= 'Product name is required, ';
            } elseif (!$data['base_price'] || $data['base_price'] == '') {
                $response_msg .= 'Product base price is required, ';
            } elseif (!$data['brand_id'] || $data['brand_id'] == '') {
                $response_msg .= 'Product brand id is required, ';
            }
            if ($response_msg != '') {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => $response_msg, 'valid' => false, 'data' => null]);
            } else {
                $product_exist = DB::table('tbl_b_products')->where('a.name', 'like', '%' . $data['name'] . '%')->first();
                if (isset($product_exist) && !empty($product_exist)) {
                    return MyHelper::_set_response('json', ['code' => 200, 'message' => 'Warning, Duplicate insert data, please use name (' . $data['name'] . ') with different one. Insert data has been canceled.', 'valid' => false, 'data' => null]);
                } else {
                    $insert_data = DB::table('tbl_b_products')->insertGetId([
                        "name" => $data['name'],
                        "base_price" => (int) $data['base_price'],
                        "description" => $data['description'],
                        "brand_id" => (int) $data['brand_id'],
                        "is_active" => ($data['is_active']) ? (int) $data['is_active'] : 0,
                        "created_by" => $this->__user_id,
                        "created_date" => MyHelper::getDateNow(),
                        "updated_date" => MyHelper::getDateNow()
                    ]);
                    if ($insert_data) {
                        return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully insert data', 'valid' => true, 'data' => ['id' => $insert_data]]);
                    } else {
                        return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed insert data', 'valid' => false, 'data' => null]);
                    }
                }
            }
        }
    }

    public function update(Request $request, $id = null) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data) && $id != null) {
            $product_id = base64_decode($id);
            $response_msg = '';
            if (!$data['name'] || $data['name'] == '') {
                $response_msg .= 'Product name is required, ';
            } elseif (!$data['base_price'] || $data['base_price'] == '') {
                $response_msg .= 'Product base price is required, ';
            } elseif (!$data['brand_id'] || $data['brand_id'] == '') {
                $response_msg .= 'Product brand id is required, ';
            }
            if ($response_msg != '') {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => $response_msg, 'valid' => false, 'data' => null]);
            } else {
                $update_data = DB::table('tbl_b_products')->where('id', $product_id)->update([
                    "name" => $data['name'],
                    "base_price" => (int) $data['base_price'],
                    "description" => $data['description'],
                    "brand_id" => (int) $data['brand_id'],
                    "is_active" => ($data['is_active']) ? (int) $data['is_active'] : 0,
                    "updated_date" => MyHelper::getDateNow()
                ]);
                if (isset($update_data) && !empty($update_data)) {
                    return MyHelper::_set_response('json', ['code' => 200, 'message' => 'Successfully update data', 'valid' => true, 'data' => ['id' => $product_id]]);
                } else {
                    return MyHelper::_set_response('json', ['code' => 200, 'message' => 'Failed update data', 'valid' => false, 'data' => null]);
                }
            }
        }
    }

    public function remove(Request $request, $id = null) {
        if ($id != null) {
            $product_id = base64_decode($id);
            //check if there is same data
            $product_exist = DB::table('tbl_b_products')->where(['id' => $product_id])->first();
            if (isset($product_exist) && !empty($product_exist)) {
                $update_data = DB::table('tbl_b_products')->where('id', $product_id)->update([
                    "is_active" => 0
                ]);
                if (isset($update_data) && !empty($update_data)) {
                    return MyHelper::_set_response('json', ['code' => 200, 'message' => 'Successfully remove data', 'valid' => true, 'data' => ['id' => $product_id]]);
                } else {
                    return MyHelper::_set_response('json', ['code' => 200, 'message' => 'Failed remove data', 'valid' => false, 'data' => null]);
                }
            }
        }
    }

    public function delete(Request $request, $id = null) {
        if ($id != null) {
            $product_id = base64_decode($id);
            $result = DB::table('tbl_b_products')->where('id', $product_id)->delete();
            if (isset($result) && !empty($result)) {
                return OrenoHelpers::_set_response('json', ['code' => 200, 'message' => 'Successfully delete data', 'valid' => true, 'data' => ['id' => $product_id]]);
            } else {
                return OrenoHelpers::_set_response('json', ['code' => 200, 'message' => 'Failed delete data', 'valid' => false, 'data' => null]);
            }
        }
    }

}
