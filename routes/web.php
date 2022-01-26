<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\Auth;
use App\Http\Middleware\AuthenticateUser;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', 'App\Http\Controllers\Frontend\UserController@index')->name('fe.index');
Route::get('/login', 'App\Http\Controllers\Frontend\UserController@login')->name('fe.login');
Route::get('/forgot-password', 'App\Http\Controllers\Frontend\UserController@forgot_password')->name('fe.forgot-password');
Route::get('/register', 'App\Http\Controllers\Frontend\UserController@register')->name('fe.register');

Route::post('/validate-token', function (Request $request) {
    return Auth::handle($request);
});

Route::group(['middleware' => 'auth.frontend'], function($e) {
    Route::prefix('profile')->group(function () {
        Route::get('/', 'App\Http\Controllers\Frontend\ProfileController@index')->name('fe.profile.index');
    });
});

Route::prefix('extraweb')->group(function () {
    Route::redirect('/', '/extraweb/login');

    Route::post('/validate-user', function (Request $request) {
        return AuthenticateUser::run($request->all());
    });

    Route::post('/save-token', function (Request $request) {
        return AuthenticateUser::save_token($request->all());
    });

    Route::prefix('login')->group(function () {
        Route::get('/', function (Request $request) {
            $data = session()->all();
            if (isset($data['_session_is_logged_in']) && !empty($data['_session_is_logged_in']) && $data['_session_is_logged_in'] == true) {
                return redirect('/extraweb/dashboard');
            } else {
                $title_for_layout = config('app.default_variables.title_for_layout');
                $_default_views = array(
                    'class' => 'Auth',
                    'method' => 'login',
                    'html' => 'Public_html.Pages.Backend.Auth.login_html',
                    'js' => 'Public_html.Pages.Backend.Auth.login_js'
                );
                $path_app_global_js = 'Public_html.Helpers.global_js';
                return view('Public_html.Layouts.Adminlte.login', ['title_for_layout' => $title_for_layout, '_default_views' => $_default_views, '_path_app_global_js' => $path_app_global_js, '_env' => config('env')]);
            }
        });
    });

    Route::prefix('ajax')->group(function () {
        Route::get('/get/{method}', 'App\Http\Controllers\Globals\AjaxController@fn_ajax_get')->name('extraweb.ajax_get');
        Route::post('/post/{method}', 'App\Http\Controllers\Globals\AjaxController@fn_ajax_post')->name('extraweb.ajax_post');
    });

    Route::group(['middleware' => 'auth.backend'], function($e) {
        Route::get('/dashboard', 'App\Http\Controllers\Backend\DashboardController@index')->name('extraweb.dashboard');
        Route::get('/preference', 'App\Http\Controllers\Backend\DashboardController@preference')->name('extraweb.preference');
        Route::get('/widget', 'App\Http\Controllers\Backend\DashboardController@widget')->name('extraweb.widget');
        
        Route::prefix('menu')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\MenuController@view')->name('extraweb.menu.view');
            Route::get('/tree_view', 'App\Http\Controllers\Backend\MenuController@tree_view')->name('extraweb.menu.tree_view');
            Route::post('/get_list', 'App\Http\Controllers\Backend\MenuController@get_list')->name('extraweb.menu.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\MenuController@edit')->name('extraweb.menu.edit');
            Route::post('/update/{method}', 'App\Http\Controllers\Backend\MenuController@update')->name('extraweb.menu.update');
        });

        Route::prefix('profile')->group(function () {
            Route::get('/', 'App\Http\Controllers\Backend\DashboardController@profile')->name('extraweb.profile');
            Route::get('/update', 'App\Http\Controllers\Backend\DashboardController@profile_update')->name('extraweb.profile_update');
            Route::post('/upload_photo', 'App\Http\Controllers\Backend\DashboardController@fnUploadPhoto')->name('extraweb.fnUploadPhoto');
        });
        
        Route::prefix('permission')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\PermissionController@view')->name('extraweb.permission.view');
            Route::post('/get_list', 'App\Http\Controllers\Backend\PermissionController@get_list')->name('extraweb.permission.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\PermissionController@edit')->name('extraweb.permission.edit');
            Route::post('/update/{method}', 'App\Http\Controllers\Backend\PermissionController@update')->name('extraweb.permission.update');
        });

        Route::prefix('group_permission')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\GroupPermissionController@view')->name('extraweb.group_permission.view');
            Route::post('/get_list', 'App\Http\Controllers\Backend\GroupPermissionController@get_list')->name('extraweb.group_permission.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\GroupPermissionController@edit')->name('extraweb.group_permission.edit');
            Route::post('/update/{method}', 'App\Http\Controllers\Backend\GroupPermissionController@update')->name('extraweb.group_permission.update');
        });
    });
});


Route::get('/get-all-session', function (Request $request) {
    dd(session()->all());
});

Route::get('/flush-session', function (Request $request) {
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
    dd(session()->all());
});

Route::post('/remove-session-flash', function (Request $request) {
    $type = $request->type;
    $close = ($request->close) ? true : false;
    $data = $request->session()->all();
    $arr_session_key = array_keys($data);
    if ($arr_session_key) {
        foreach ($arr_session_key AS $keywords => $values) {
            if ($values == 'alert-msg' && $close == true && $type == 'alert') {
                session()->forget($values);
            }
        }
    }
    session()->save();
});
