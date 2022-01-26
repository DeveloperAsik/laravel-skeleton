<?php

namespace App\Http\Controllers\Frontend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\Controller;
/**
 * Description of UserController
 *
 * @author I00396.ARIF
 */
use Illuminate\Http\Request;
use App\Helpers\MyHelper;

class UserController extends Controller {

    //put your code here
    public function index(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        return view('Public_html.Layouts.Adminlte.ajax', compact('title_for_layout'));
    }
    public function login(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        return view('Public_html.Layouts.Adminlte.ajax', compact('title_for_layout'));
    }

}
