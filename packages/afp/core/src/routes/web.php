<?php
/**
 * Backend Routes
 */
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function () {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {
        /*
         * dashboard - home
         */
        Route::post('show-alert', 'GlobalController@showalert')->name('afp.core.global.showalert');
        Route::get('show-alert', function () {
            return redirect()->route('afp.core.dashboard.index');
        });
        Route::post('afp/core/global/syncdata', 'GlobalController@syncdata')->name('afp.core.global.syncdata');
        Route::get('dashboard', 'DashboardController@index')->name('afp.core.dashboard.index');
        Route::get('', 'DashboardController@index')->name('afp.core.dashboard.index');

        Route::post('report/exportSite', 'ReportController@exportSite')->name('afp.core.report.exportSite');
        Route::post('report/exportZone', 'ReportController@exportZone')->name('afp.core.report.exportZone');
        Route::get('report', 'ReportController@manage')->name('afp.core.report.manage');
        Route::get('report/{site_id}', 'ReportController@detail')
            ->where('site_id', '[0-9]+')
            ->name('afp.core.report.detail');

        Route::get('afp/core/zone-cpc/manage/{site_id}', 'ZoneCpcController@manage')
            ->where('site_id', '[0-9]+')
            ->name('afp.core.zone-cpc.manage');

        Route::post('afp/core/zone-cpc/manage/add', 'ZoneCpcController@add')->name('afp.core.zone-cpc.add');
        Route::post('afp/core/zone-cpc/manage/update', 'ZoneCpcController@update')->name('afp.core.zone-cpc.update');
        Route::get('afp/core/zone-cpc/manage/show', 'ZoneCpcController@show')->name('afp.core.zone-cpc.show');
        Route::post('afp/core/zone-cpc/manage/delete', 'ZoneCpcController@delete')->name('afp.core.zone-cpc.delete');
        Route::post('afp/core/zone-cpc/manage/status', 'ZoneCpcController@status')->name('afp.core.zone-cpc.status');

        Route::get('afp/core/user-info/list', 'UserInfoController@manage')->name('afp.core.user-info.list');
        Route::post('afp/core/user-info/add', 'UserInfoController@add')->name('afp.core.user-info.add');
        Route::post('afp/core/user-info/update', 'UserInfoController@update')->name('afp.core.user-info.update');
        Route::get('afp/core/user-info/show', 'UserInfoController@show')->name('afp.core.user-info.show');

        Route::get('afp/core/payment/sync', 'PaymentController@sync')->name('afp.core.payment.sync');
        Route::get('afp/core/payment/manage', 'PaymentController@manage')->name('afp.core.payment.manage');
        Route::post('afp/core/payment/upload', 'PaymentController@upload')->name('afp.core.payment.upload');
        Route::post('afp/core/payment/exportExcel', 'PaymentController@exportExcel')->name('afp.core.payment.exportExcel');

//        Route::get('afp/core/zone-adx/manage/{site_id}', 'ZoneAdxController@manage')
//            ->where('site_id', '[0-9]+')
//            ->name('afp.core.zone-adx.manage');
//        Route::post('afp/core/zone-adx/manage/add', 'ZoneAdxController@add')->name('afp.core.zone-adx.add');
//        Route::post('afp/core/zone-adx/manage/update', 'ZoneAdxController@update')->name('afp.core.zone-adx.update');
//        Route::get('afp/core/zone-adx/manage/show', 'ZoneAdxController@show')->name('afp.core.zone-adx.show');
//        Route::post('afp/core/zone-adx/manage/delete', 'ZoneAdxController@delete')->name('afp.core.zone-adx.delete');
//        Route::post('afp/core/zone-adx/manage/status', 'ZoneAdxController@status')->name('afp.core.zone-adx.status');

        Route::get('afp/core/site/manage', 'SiteController@index')->name('afp.core.site.manage');
        Route::post('afp/core/site/add', 'SiteController@add')->name('afp.core.site.add');
        Route::get('afp/core/site/show', 'SiteController@show')->name('afp.core.site.show');
        Route::get('afp/core/site/get', 'SiteController@getSitename')->name('afp.core.site.get');
        Route::get('afp/core/site/get-username', 'SiteController@getUsername')->name('afp.core.site.get-username');
//        Route::get('afp/core/site/showadx', 'SiteController@showadx')->name('afp.core.site.showadx');
        Route::post('afp/core/site/update', 'SiteController@update')->name('afp.core.site.update');
//        Route::post('afp/core/site/updateadx', 'SiteController@updateadx')->name('afp.core.site.updateadx');
        Route::post('afp/core/site/delete', 'SiteController@delete')->name('afp.core.site.delete');
        Route::post('afp/core/site/status', 'SiteController@status')->name('afp.core.site.status');
//        Route::post('afp/core/site/statusadx', 'SiteController@statusadx')->name('afp.core.site.statusadx');
//        Route::post('afp/core/site/addadx', 'SiteController@addadx')->name('afp.core.site.addadx');

        Route::get('afp/core/site/getsitedk', 'DashboardController@getsitedk')->name('afp.core.site.getsitedk');
        Route::get('afp/core/site/findsitedk', 'DashboardController@findsitedk')->name('afp.core.site.findsitedk');

        Route::get('afp/core/tag/list', 'TagController@manage')->name('afp.core.tag.list');
        Route::get('afp/core/tag/show', 'TagController@show')->name('afp.core.tag.show');
        Route::post('afp/core/tag/update', 'TagController@update')->name('afp.core.tag.update');
        Route::post('afp/core/tag/delete', 'TagController@delete')->name('afp.core.tag.delete');
        Route::post('afp/core/tag/add', 'TagController@add')->name('afp.core.tag.add');

        Route::get('afp/core/box-format/list', 'BoxFormatController@manage')->name('afp.core.box-format.list');
        Route::get('afp/core/box-format/show', 'BoxFormatController@show')->name('afp.core.box-format.show');
        Route::post('afp/core/box-format/update', 'BoxFormatController@update')->name('afp.core.box-format.update');
        Route::post('afp/core/box-format/delete', 'BoxFormatController@delete')->name('afp.core.box-format.delete');
        Route::post('afp/core/box-format/add', 'BoxFormatController@add')->name('afp.core.box-format.add');

        Route::get('afp/core/payment-mail/manage', 'PaymentMailController@manage')->name('afp.core.payment-mail.manage');
        Route::get('afp/core/payment-mail/show', 'PaymentMailController@show')->name('afp.core.payment-mail.show');
        Route::post('afp/core/payment-mail/update', 'PaymentMailController@update')->name('afp.core.payment-mail.update');
        Route::post('afp/core/payment-mail/delete', 'PaymentMailController@delete')->name('afp.core.payment-mail.delete');
        Route::post('afp/core/payment-mail/add', 'PaymentMailController@add')->name('afp.core.payment-mail.add');
        Route::post('afp/core/payment-mail/status', 'PaymentMailController@status')->name('afp.core.payment-mail.status');

        Route::get('afp/core/zone-template/list', 'ZoneTemplateController@manage')->name('afp.core.zone-template.list');
        Route::get('afp/core/zone-template/show', 'ZoneTemplateController@show')->name('afp.core.zone-template.show');
        Route::post('afp/core/zone-template/update', 'ZoneTemplateController@update')->name('afp.core.zone-template.update');
        Route::post('afp/core/zone-template/delete', 'ZoneTemplateController@delete')->name('afp.core.zone-template.delete');
        Route::post('afp/core/zone-template/add', 'ZoneTemplateController@add')->name('afp.core.zone-template.add');

        Route::get('afp/core/channel/list', 'ChannelController@manage')->name('afp.core.channel.list');
        Route::get('afp/core/channel/show', 'ChannelController@show')->name('afp.core.channel.show');
        Route::post('afp/core/channel/update', 'ChannelController@update')->name('afp.core.channel.update');
        Route::post('afp/core/channel/delete', 'ChannelController@delete')->name('afp.core.channel.delete');
        Route::post('afp/core/channel/add', 'ChannelController@add')->name('afp.core.channel.add');

        Route::get('afp/core/category/list', 'SiteCategoryController@manage')->name('afp.core.category.list');
        Route::get('afp/core/category/show', 'SiteCategoryController@show')->name('afp.core.category.show');
        Route::post('afp/core/category/update', 'SiteCategoryController@update')->name('afp.core.category.update');
        Route::post('afp/core/category/delete', 'SiteCategoryController@delete')->name('afp.core.category.delete');
        Route::post('afp/core/category/add', 'SiteCategoryController@add')->name('afp.core.category.add');
    });
});