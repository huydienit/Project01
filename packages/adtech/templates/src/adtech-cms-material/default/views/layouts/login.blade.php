<html>
<head>
    @include('includes.head')
    @yield('styles')
</head>
<body class="adtech-app-body" layout="row" aria-label="{{ config('app.name') }}">
<div ng-controller="RootCtrl" class="header" ng-app="AdtechApp">
    <div layout="column" tabIndex="-1" role="main" flex>
        @yield('content')
    </div>
</div>
@include('includes.loading')
@stack('scripts-footer')
</body>
</html>