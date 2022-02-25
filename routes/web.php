<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;

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
Route::middleware(['auth'])->group(function ($e) {
    /*
     * 
     * front end routes start here
     * 
     */

    Route::get('/', 'App\Http\Controllers\Frontend\UserController@index')->name('fe.index');

    /*
     * 
     * front end routes end here
     * 
     */

    /*
     * 
     * back end routes start here
     * 
     */
    Route::group(['prefix' => 'extraweb'], function($e) {
        Route::get('/', 'App\Http\Controllers\Backend\AuthController@login')->name('extraweb.login');
        Route::get('/login', 'App\Http\Controllers\Backend\AuthController@login')->name('extraweb.login');
        Route::get('/logout', 'App\Http\Controllers\Backend\AuthController@logout')->name('extraweb.logout');
        Route::post('/validate-user', function (Request $request) {
            return Authenticate::validate_user($request->all());
        })->name('extraweb.validate');
        Route::post('/save-token', function (Request $request) {
            return Authenticate::save_token($request->all());
        })->name('extraweb.save_token');
        Route::get('/dashboard', 'App\Http\Controllers\Backend\DashboardController@index')->name('extraweb.dashboard');

        Route::prefix('ajax')->group(function () {
            Route::get('/get/{method}', 'App\Http\Controllers\Globals\AjaxController@fn_ajax_get')->name('extraweb.ajax_get');
            Route::post('/post/{method}', 'App\Http\Controllers\Globals\AjaxController@fn_ajax_post')->name('extraweb.ajax_post');
        });

        Route::prefix('menu')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\MenuController@view')->name('extraweb.menu.view');
            Route::get('/create', 'App\Http\Controllers\Backend\MenuController@create')->name('extraweb.menu.create');
            Route::get('/tree_view', 'App\Http\Controllers\Backend\MenuController@tree_view')->name('extraweb.menu.tree_view');
            Route::post('/get_list', 'App\Http\Controllers\Backend\MenuController@get_list')->name('extraweb.menu.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\MenuController@edit')->name('extraweb.menu.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Backend\MenuController@update')->name('extraweb.menu.update');
        });

        Route::prefix('profile')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\ProfileController@view')->name('extraweb.profile');
            Route::get('/update', 'App\Http\Controllers\Backend\ProfileController@update')->name('extraweb.profile_update');
            Route::post('/upload_photo', 'App\Http\Controllers\Backend\ProfileController@fnUploadPhoto')->name('extraweb.fnUploadPhoto');
        });
        Route::prefix('classes')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\ClassesController@view')->name('extraweb.classes.view');
            Route::get('/create', 'App\Http\Controllers\Backend\ClassesController@create')->name('extraweb.classes.create');
            Route::post('/get_list', 'App\Http\Controllers\Backend\ClassesController@get_list')->name('extraweb.classes.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\ClassesController@edit')->name('extraweb.classes.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Backend\ClassesController@update')->name('extraweb.classes.update');
            Route::post('/insert', 'App\Http\Controllers\Backend\ClassesController@insert')->name('extraweb.classes.insert');
        });

        Route::prefix('user')->group(function () {
            Route::get('/create', 'App\Http\Controllers\Backend\UsersController@create')->name('extraweb.users.create');
            Route::get('/view', 'App\Http\Controllers\Backend\UsersController@view')->name('extraweb.users.view');
            Route::post('/get_list', 'App\Http\Controllers\Backend\UsersController@get_list')->name('extraweb.users.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\UsersController@edit')->name('extraweb.users.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Backend\UsersController@update')->name('extraweb.users.update');
        });

        Route::prefix('group')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\GroupsController@view')->name('extraweb.group.view');
            Route::post('/get_list', 'App\Http\Controllers\Backend\GroupsController@get_list')->name('extraweb.group.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\GroupsController@edit')->name('extraweb.group.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Backend\GroupsController@update')->name('extraweb.group.update');
        });

        Route::prefix('permission')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\PermissionController@view')->name('extraweb.permission.view');
            Route::get('/create', 'App\Http\Controllers\Backend\PermissionController@create')->name('extraweb.permission.create');
            Route::post('/get_list', 'App\Http\Controllers\Backend\PermissionController@get_list')->name('extraweb.permission.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\PermissionController@edit')->name('extraweb.permission.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Backend\PermissionController@update')->name('extraweb.permission.update');
            Route::post('/insert', 'App\Http\Controllers\Backend\PermissionController@insert')->name('extraweb.permission.insert');
        });

        Route::prefix('group_permission')->group(function () {
            Route::get('/view', 'App\Http\Controllers\Backend\GroupsPermissionsController@view')->name('extraweb.group_permission.view');
            Route::post('/get_list', 'App\Http\Controllers\Backend\GroupsPermissionsController@get_list')->name('extraweb.group_permission.get_list');
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\GroupsPermissionsController@edit')->name('extraweb.group_permission.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Backend\GroupsPermissionsController@update')->name('extraweb.group_permission.update');
        });
    });
    /*
     * 
     * back end routes end here
     * 
     */
});


Route::get('/get-all-session', function (Request $request) {
    dd(session()->all());
});

Route::get('/flush-session', function (Request $request) {
    Authenticate::clear_session();
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
