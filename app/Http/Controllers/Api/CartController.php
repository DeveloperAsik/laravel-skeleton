<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

/**
 * Description of CartController
 *
 * @author I00396.ARIF
 */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;

class CartController extends Controller {

    //put your code here
    public function get_list(Request $request) {
        $limit = ($request->limit) ? $request->limit : 10;
        $offset = ($request->offset) ? $request->offset : 0;
        $cart = DB::table('tbl_c_carts AS a')
                ->select('a.id', 'a.code', 'a.subtotal_tax', 'a.grandtotal_price', 'a.is_active', 'a.created_date')
                ->offset($offset)
                ->limit($limit)
                ->get();
        $data = [];
        if (isset($cart) && !empty($cart)) {
            foreach ($cart AS $keyword => $value) {
                $items = DB::table('tbl_c_cart_items AS a')
                        ->select('a.id AS cart_item_id', 'a.sku', 'a.qty', 'a.price', 'a.total_price', 'a.discount_price', 'a.tax_price')
                        ->where('a.created_by', '=', $this->__user_id)
                        ->get();
                if (isset($items) && !empty($items)) {
                    $item_list = [];
                    foreach ($items AS $k => $val) {
                        $item_list[] = $val;
                    }
                }
                $data[] = [
                    'id' => $value->id,
                    'code' => $value->code,
                    'subtotal_tax' => $value->subtotal_tax,
                    'grandtotal_price' => $value->grandtotal_price,
                    'is_active' => $value->is_active,
                    'created_date' => $value->created_date,
                    'items' => $item_list
                ];
            }
        }
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
            $grandtotal_price = $subtotal_tax = 0;
            $response_msg = '';
            foreach ($data AS $key => $value) {
                if (!$value['sku'] || $value['sku'] == '') {
                    $response_msg .= 'Product sku is required, ';
                } elseif (!$value['qty'] || $value['qty'] == '') {
                    $response_msg .= 'Product qty is required, ';
                } elseif (!$value['price'] || $value['price'] == '') {
                    $response_msg .= 'Product price is required, ';
                }
                $grandtotal_price += (int) $value['qty'] * (int) $value['price'];
                $grandtotal_price += (int) $value['discount_price'];
                $grandtotal_price += (int) $value['tax_price'];
                $subtotal_tax += (int) $value['tax_price'];
            }
            if ($response_msg != '') {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => $response_msg, 'valid' => false, 'data' => null]);
            } else {
                //insert cart tbl_c_carts
                $cart_exist = DB::table('tbl_c_carts')->where('created_by', '=', $this->__user_id)->first();
                if (isset($cart_exist) && !empty($cart_exist) && $cart_exist != null) {
                    $cart = DB::table('tbl_c_carts')->where('id', '=', $cart_exist->id)->update([
                        "subtotal_tax" => (int) $subtotal_tax + (int) $cart_exist->subtotal_tax,
                        "grandtotal_price" => (int) $grandtotal_price + (int) $cart_exist->grandtotal_price,
                        "created_by" => $this->__user_id,
                        "updated_date" => MyHelper::getDateNow()
                    ]);
                    $cart_id = $cart_exist->id;
                } else {
                    $cart = DB::table('tbl_c_carts')->insertGetId([
                        "code" => MyHelper::getRandomChar(16),
                        "subtotal_tax" => (int) $subtotal_tax,
                        "grandtotal_price" => (int) $grandtotal_price,
                        "is_active" => 1,
                        "created_by" => $this->__user_id,
                        "created_date" => MyHelper::getDateNow(),
                        "updated_date" => MyHelper::getDateNow()
                    ]);
                    $cart_id = $cart;
                }
                foreach ($data AS $key => $value) {
                    $product_exist = DB::table('tbl_c_cart_items')->where('sku', 'like', '%' . $value['sku'] . '%')->first();
                    if (isset($product_exist) && !empty($product_exist)) {
                        $qty = 1;
                        if ((int) $value['qty'] == (int) $product_exist->qty) {
                            $qty = $value['qty'];
                        } elseif ((int) $value['qty'] > (int) $product_exist->qty || (int) $value['qty'] < (int) $product_exist->qty) {
                            $qty = $value['qty'];
                        }
                        $total_price = (int) $qty * (int) $value['price'];
                        $data = DB::table('tbl_c_cart_items')->where('id', '=', $product_exist->id)->update([
                            "cart_id" => $cart_id,
                            "sku" => $value['sku'],
                            "qty" => (int) $qty,
                            "price" => $value['price'],
                            "total_price" => (int) $total_price,
                            "discount_price" => $value['discount_price'],
                            "tax_price" => $value['tax_price'],
                            "is_active" => 1,
                            "created_by" => $this->__user_id,
                            "updated_date" => MyHelper::getDateNow()
                        ]);
                        $id = $product_exist->id;
                    } else {
                        $total_price = (int) $value['qty'] * (int) $value['price'];
                        $data = DB::table('tbl_c_cart_items')->insertGetId([
                            "cart_id" => $cart_id,
                            "sku" => $value['sku'],
                            "qty" => (int) $value['qty'],
                            "price" => $value['price'],
                            "total_price" => (int) $total_price,
                            "discount_price" => $value['discount_price'],
                            "tax_price" => $value['tax_price'],
                            "is_active" => 1,
                            "created_by" => $this->__user_id,
                            "created_date" => MyHelper::getDateNow(),
                            "updated_date" => MyHelper::getDateNow()
                        ]);
                        $id = $data;
                    }
                }
            }
            if ($data) {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully insert data', 'valid' => true, 'data' => ['id' => $id]]);
            } else {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed insert data', 'valid' => false, 'data' => null]);
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
                $update_data = DB::table('tbl_c_carts')->where('id', $product_id)->update([
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
            $product_exist = DB::table('tbl_c_carts')->where(['id' => $product_id])->first();
            if (isset($product_exist) && !empty($product_exist)) {
                $update_data = DB::table('tbl_c_carts')->where('id', $product_id)->update([
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
            $result = DB::table('tbl_c_carts')->where('id', $product_id)->delete();
            if (isset($result) && !empty($result)) {
                return OrenoHelpers::_set_response('json', ['code' => 200, 'message' => 'Successfully delete data', 'valid' => true, 'data' => ['id' => $product_id]]);
            } else {
                return OrenoHelpers::_set_response('json', ['code' => 200, 'message' => 'Failed delete data', 'valid' => false, 'data' => null]);
            }
        }
    }

    public function checkout(Request $request) {
        $data = $request->json()->all();
        if (isset($data) && !empty($data)) {
            $grandtotal_price = $subtotal_tax = 0;
            foreach ($data['items'] AS $key => $value) {
                $grandtotal_price += (int) $value['qty'] * (int) $value['price'];
                $grandtotal_price += (int) $value['discount_price'];
                $grandtotal_price += (int) $value['tax_price'];
                $subtotal_tax += (int) $value['tax_price'];
            }
            if ($grandtotal_price > 0) {
                $order = DB::table('tbl_d_orders')->insertGetId([
                    "shipping_address" => $data['shipping_address'],
                    "shipping_bill" => isset($data['shipping_bill']) ? $data['shipping_bill'] : "-",
                    "subtotal_tax" => $data['subtotal_tax'],
                    "grandtotal_price" => $data['grandtotal_price'],
                    "shipping_vendor_id" => $data['shipping_vendor_id'],
                    "shipping_cost_id" => $data['shipping_cost_id'],
                    "payment_id" => $data['payment_id'],
                    "is_active" => 1,
                    "created_by" => $this->__user_id,
                    "created_date" => MyHelper::getDateNow(),
                    "updated_date" => MyHelper::getDateNow()
                ]);
                if ($order) {
                    $errMsg = '';
                    foreach ($data['items'] AS $key => $value) {
                        $product_exist = DB::table('tbl_b_product_stocks')->where('sku', 'like', '%' . $value['sku'] . '%')->first();
                        if ($product_exist->stock_end > 0 && $value['qty'] <= $product_exist->stock_end) {
                            $total_price = (int) $value['qty'] * (int) $value['price'];
                            $stock_in = $product_exist->stock_in;
                            $stock_out = (int) $product_exist->stock_out + (int) $value['qty'];
                            DB::table('tbl_b_product_stocks')->where('id', '=', $product_exist->id)->update([
                                "stock_out" => (int) $stock_out,
                                "stock_end" => (int) $stock_in - (int) $stock_out,
                                "created_by" => $this->__user_id,
                                "updated_date" => MyHelper::getDateNow()
                            ]);
                            $data = DB::table('tbl_d_order_items')->insertGetId([
                                "sku" => $value['sku'],
                                "qty" => (int) $value['qty'],
                                "price" => $value['price'],
                                "total_price" => (int) $total_price,
                                "discount_price" => $value['discount_price'],
                                "tax_price" => $value['tax_price'],
                                "is_active" => 1,
                                "created_by" => $this->__user_id,
                                "updated_date" => MyHelper::getDateNow()
                            ]);
                        } else {
                            $errMsg .= 'Warning! Product with sku : ' . $value['sku'] . ' is unavailable at the moment, please contact administrator or change product to another.';
                        }
                    }
                    return MyHelper::_set_response('json', ['code' => 200, 'message' => $errMsg, 'valid' => false, 'data' => null]);
                } else {
                    return MyHelper::_set_response('json', ['code' => 500, 'message' => 'Something went wrong, failed insert data into order', 'valid' => false, 'data' => null]);
                }
            } else {
                return MyHelper::_set_response('json', ['code' => 200, 'message' => 'Something went wrong, grand total price cannot empty or 0', 'valid' => false, 'data' => null]);
            }
        }
    }

}
