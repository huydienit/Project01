<html>
<head>
    @include('includes.head')
    @yield('styles')
    @yield('styles-more')
</head>
<body class="adtech-app-body" ng-app="AdtechApp" ng-controller="RootCtrl as rootCtrl" layout="row" ng-cloak
      aria-label="{{ config('app.name') }}">
<div layout="column" tabIndex="-1" role="main" flex>
    @include('includes.toolbar_intro')
    <md-content md-scroll-y layout="column" flex>
        @yield('content')
        @include('includes.footer')
    </md-content>
</div>
@stack('scripts-footer')
@stack('scripts-view')
</body>
</html>