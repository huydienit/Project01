<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<link rel="icon" sizes="192x192" href="images/android-desktop.png">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="apple-mobile-web-app-title" content="{{ 'app.name' }}"/>

<link rel="shortcut icon" href="/images/favicon.png"/>
<title>{{ config('app.name') }}</title>

@section('styles')
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&lang=en"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/css/dialog-polyfill.min.css"/>
    <link rel="stylesheet"
          href="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/css/material.deep_orange-orange.min.css"/>
    <link rel="stylesheet" href="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/css/mdl-selectfield.min.css"/>
    <link rel="stylesheet" href="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/css/styles.css"/>
@stop

@section('scripts')
    <script type="text/javascript"
            src="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/js/dialog-polyfill.min.js"></script>
    <script type="text/javascript" src="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/js/material.min.js"></script>
    <script type="text/javascript"
            src="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/js/mdl-selectfield.min.js"></script>
    <script type="text/javascript" src="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/js/scripts.js"></script>
@stop