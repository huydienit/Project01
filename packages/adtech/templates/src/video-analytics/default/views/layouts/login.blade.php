<!doctype html>
<html lang="en" ng-app="AdtechApp" ng-controller="BaseController">
<head>
    @include('includes.head')
    @yield('styles')
</head>
<body class="adtech-app-body" layout="row" ng-cloak aria-label="{{ config('app.name') }}">
<div layout="column" tabIndex="-1" role="main" flex>
    @yield('content')
</div>
@include('includes.footer')
@stack('scripts-footer')
</body>
</html>