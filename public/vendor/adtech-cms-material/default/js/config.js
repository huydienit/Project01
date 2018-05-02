'use strict';

angular
    .module("AdtechApp")
    .config(function($mdThemingProvider) {
        $mdThemingProvider
            .theme('default')
            .primaryPalette('blue')
            .accentPalette('green')
            .warnPalette('red')
            .backgroundPalette('grey');
        $mdThemingProvider
            .theme("success-toast")
            .backgroundPalette('red');
        $mdThemingProvider
            .theme("error-toast");
    });