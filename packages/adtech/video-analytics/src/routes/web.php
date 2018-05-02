<?php

/**
 * Frontend Routes
 */
Route::group(['middleware' => ['auth:adtech']], function () {
    Route::get('video/dashboard', 'DashboardController@index')->name('adtech.video-analytics.dashboard.index');
});

/**
 * Backend Routes
 */
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function () {
    Route::group(['middleware' => ['auth:adtech']], function () {
        /*
         * dashboard - index
         */
        Route::get('video/dashboard', 'DashboardController@index')->name('adtech.video-analytics.dashboard.index');
    });
});