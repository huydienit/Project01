<!doctype html>
<html ng-app="AdtechApp" ng-controller="BaseController" lang="en">
<head>
    @include('includes.head')
    @yield('styles')
</head>
<body class="adtech-app-body" layout="row" ng-cloak aria-label="{{ config('app.name') }}">
@include('includes.sidebar')
<div layout="column" tabIndex="-1" role="main" flex>
    <md-toolbar class="md-whiteframe-glow-z1 site-content-toolbar">
        <div class="md-toolbar-tools" tabIndex="-1">
            <md-button class="md-icon-button" ng-click="openMenu()" hide-gt-sm aria-label="Toggle Menu">
                <md-icon
                        md-svg-src="{{ asset('vendor/adtech-cms-material/default/latest/ic_menu_24px.svg') }}"></md-icon>
            </md-button>
            <div layout="row" flex class="fill-height">
                <h2 class="md-toolbar-item md-breadcrumb md-headline">
                    <span class="md-breadcrumb-page">Dashboard</span>
                </h2>
            </div>
            <md-button
                    class="md-icon-button"
                    aria-label="More"
                    ng-click="showToolbarMenu($event, 'settings')">
                <md-icon md-svg-icon="{{ asset('vendor/adtech-cms-material/default/latest/more_vert.svg') }}"></md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <div>
        <md-content class="md-padding">
            @yield('content')
            @include('includes.scrollTop')
        </md-content>
    </div>
</div>
@include('includes.footer')
@stack('scripts-footer')
</body>
</html>