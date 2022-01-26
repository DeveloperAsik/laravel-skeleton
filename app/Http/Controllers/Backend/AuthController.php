<?php

namespace App\Http\Controllers\Backend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\Controller;
/**
 * Description of DefaultController
 *
 * @author I00396.ARIF
 */
use Illuminate\Http\Request;

class AuthController extends Controller {

    //put your code here
    public function login(Request $request) {
        $title_for_layout = config('app.default_variables.title_for_layout');
        return view('Public_html.Layouts.Adminlte.login', compact('title_for_layout'));
    }


}
