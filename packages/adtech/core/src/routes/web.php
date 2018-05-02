<?php

/**
 * Frontend Routes
 */
Route::group(array('prefix' => null), function () {
    /*
     * auth - login
     */
    Route::match(['get', 'post'], 'login', 'Auth\LoginController@login')->name('adtech.core.auth.login');

    Route::match(['get', 'post'], 'register', 'Auth\RegisterController@create')->name('adtech.core.auth.register');

    Route::match(['get', 'post'], 'forgot-password', 'Auth\ForgotPasswordController@forgot')->name('adtech.core.auth.forgot');

    Route::match(['get', 'post'], 'reset-password/{reset_token}', 'Auth\ResetPasswordController@reset')->name('adtech.core.auth.reset');

    Route::group(['middleware' => ['adtech.auth']], function () {
        /*
         * Activate
         */
        Route::get('activate/{token}', 'ActivateController@activate')->name('adtech.core.activate.activate');
        /*
         * Activate - Resend
         */
        Route::get('activate/resend', 'ActivateController@resend')->name('adtech.core.activate.resend');
        /*
         * Auth - Logout
         */
        Route::get('logout', 'Auth\LoginController@logout')->name('adtech.core.auth.logout');
    });
});

/**
 * Backend Routes
 */
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function () {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {

        Route::get('adtech/core/role/list', 'RoleController@manage')->name('adtech.core.role.list');
        Route::get('adtech/core/role/show', 'RoleController@show')->name('adtech.core.role.show');
        Route::post('adtech/core/role/update', 'RoleController@update')->name('adtech.core.role.update');
        Route::post('adtech/core/role/delete', 'RoleController@delete')->name('adtech.core.role.delete');
        Route::post('adtech/core/role/add', 'RoleController@add')->name('adtech.core.role.add');

        Route::get('adtech/core/user/list', 'UserController@manage')->name('adtech.core.user.list');
        Route::get('adtech/core/user/show', 'UserController@show')->name('adtech.core.user.show');
        Route::post('adtech/core/user/update', 'UserController@update')->name('adtech.core.user.update');
        Route::post('adtech/core/user/delete', 'UserController@delete')->name('adtech.core.user.delete');
        Route::post('adtech/core/user/add', 'UserController@add')->name('adtech.core.user.add');
        Route::post('adtech/core/user/status', 'UserController@status')->name('adtech.core.user.status');

        Route::get('adtech/core/route/list', 'RouteController@manage')->name('adtech.core.route.list');
        /**
         * Permission Details
         */
        Route::get('adtech/core/permission/{object_type}/{object_id}', 'PermissionController@details')
            ->where('object_type', '[role|user|group]+')
            ->where('object_id', '[0-9]+')
            ->name('adtech.core.permission.details');

        Route::post('adtech/core/permission/set', 'PermissionController@set')->name('adtech.core.permission.set');
    });
});