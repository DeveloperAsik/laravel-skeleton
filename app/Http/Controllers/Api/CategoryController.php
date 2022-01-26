<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

/**
 * Description of CategoryController
 *
 * @author I00396.ARIF
 */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller {

    //put your code here
    public function get_list(Request $request) {
        $limit = ($request->limit) ? $request->limit : 10;
        $offset = ($request->offset) ? $request->offset : 0;
        $level = ($request->level);
        $grouping_categories = [];
        if ($level != null) {
            $data = DB::table('tbl_b_categories AS a')
                    ->select('a.id', 'a.name', 'a.level', 'a.description')
                    ->where('a.level', '=', $level)
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
        } else {
            $level = 1;
            $category_1 = DB::table('tbl_b_categories AS a')
                    ->select('a.id', 'a.name', 'a.level', 'a.description')
                    ->where('a.level', '=', $level)
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
            $grouping_categories = DB::table('tbl_b_categories')->selectRaw('count(id) as id')->having('level', '!=', 1)->groupBy('level')->get();
            $category = [];
            if (isset($category_1) && !empty($category_1) && $grouping_categories) {
                foreach ($category_1 AS $keyword1 => $value1) {
                    $category_2 = DB::table('tbl_b_categories AS a')->select('a.id', 'a.name', 'a.level', 'a.description')->where('a.parent_id', '=', $value1->id)->where('a.level', '=', 2)->get();
                    $category_2_data = [];
                    if (isset($category_2) && !empty($category_2)) {
                        foreach ($category_2 AS $keyword2 => $value2) {
                            $category_3 = DB::table('tbl_b_categories AS a')->select('a.id', 'a.name', 'a.level', 'a.description')->where('a.parent_id', '=', $value2->id)->where('a.level', '=', 3)->get();
                            $category_3_data = [];
                            if (isset($category_3) && !empty($category_3)) {
                                foreach ($category_3 AS $keyword3 => $value3) {
                                    $category_4 = DB::table('tbl_b_categories AS a')->select('a.id', 'a.name', 'a.level', 'a.description')->where('a.parent_id', '=', $value3->id)->where('a.level', '=', 4)->get();
                                    $category_4_data = [];
                                    if (isset($category_4) && !empty($category_4)) {
                                        foreach ($category_4 AS $keyword4 => $value4) {
                                            $category_5 = DB::table('tbl_b_categories AS a')->select('a.id', 'a.name', 'a.level', 'a.description')->where('a.parent_id', '=', $value4->id)->where('a.level', '=', 5)->get();
                                            $category_4_data[] = [
                                                'id' => $value3->id,
                                                'name' => $value3->name,
                                                'description' => $value3->description,
                                                'child' => $category_5
                                            ];
                                        }
                                    }
                                    $category_3_data[] = [
                                        'id' => $value3->id,
                                        'name' => $value3->name,
                                        'description' => $value3->description,
                                        'child' => $category_4_data
                                    ];
                                }
                            }
                            $category_2_data[] = [
                                'id' => $value1->id,
                                'name' => $value1->name,
                                'description' => $value1->description,
                                'child' => $category_3_data
                            ];
                        }
                    }
                    $category[] = [
                        'id' => $value1->id,
                        'name' => $value1->name,
                        'description' => $value1->description,
                        'child' => $category_2_data
                    ];
                }
            }
            $data = MyHelper::convertToObject($category);
        }
        if (isset($data) && !empty($data)) {
            $meta = [
                'total' => DB::table('tbl_b_categories')->where('level', '=', $level)->count(),
                'offset' => $offset,
                'limit' => $limit,
                'query_param' => $request->getRequestUri()
            ];
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully fetching data', 'valid' => true, 'meta' => $meta, 'data' => $data]);
        } else {
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed fetching data', 'valid' => false, 'data' => null]);
        }
    }

    public function get_by_level_list(Request $request) {
        $limit = ($request->limit) ? $request->limit : 10;
        $offset = ($request->offset) ? $request->offset : 0;
        $data = DB::table('tbl_b_categories AS a')
                ->where('a.level', '=', $level)
                ->offset($offset)
                ->limit($limit)
                ->get();
        if (isset($data) && !empty($data)) {
            $meta = [
                'total' => DB::table('tbl_b_categories')->where('level', '=', $level)->count(),
                'offset' => $offset,
                'limit' => $limit
            ];
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'successfully fetching data', 'valid' => true, 'meta' => $meta, 'data' => $data]);
        } else {
            return MyHelper::_set_response('json', ['code' => 200, 'message' => 'failed fetching data', 'valid' => false, 'data' => null]);
        }
    }

}
