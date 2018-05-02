<?php

return [
    'version' => '1.0.0',
    /*
    |--------------------------------------------------------------------------
    | Google Recaptcha
    |--------------------------------------------------------------------------
    */
    'google_recaptcha' => [
        'site_key' => '6LcOqQ4TAAAAABtzBkFsBf9RoqXtKICQ9bqoEPKf',
        'secret' => '6LcOqQ4TAAAAAN4uiSDcki1-v9IGsc-U4tS1i3go',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exception class
    |--------------------------------------------------------------------------
    */
    'exception_handler' => '\Adtech\Application\Cms\Exceptions\Handler',

    /*
    |--------------------------------------------------------------------------
    | Config user activation
    |--------------------------------------------------------------------------
    */
    'user_activation' => true,

    /*
    |--------------------------------------------------------------------------
    | Website backend url
    |--------------------------------------------------------------------------
    */
    'admin_prefix' => 'admin',
    'homepage' => [
        'frontend' => [
            'method' => 'get',
            'uri' => '/',
            'middleware' => [],
            'action' => 'Afp\Core\App\Http\Controllers\DashboardController@intro',
        ],
        'backend' => [
            'method' => 'get',
            'uri' => '/',
            'middleware' => [],
            'action' => 'Afp\Core\App\Http\Controllers\DashboardController@index',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Website template
    |--------------------------------------------------------------------------
    */
    'group_name' => 'afp-cms',
    'angular_js' => true,
    'desktop' => [
        'template' => 'default',
        'skin' => 'default'
    ],
    'mobile' => [
        'template' => 'default',
        'skin' => 'default'
    ],
    'modules' => [
        /**
         * vendor => [packages or modules]
         * example: 'adtech' => ['core', 'blog']
         */
        'adtech' => ['core'],
        'afp' => ['core']
    ],
    'firebase' => [
        'domain' => '',
        'app_key' => '',
        'url_message' => '',
    ],
];