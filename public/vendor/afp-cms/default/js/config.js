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
        $mdThemingProvider.theme('silver', 'default')
            .primaryPalette('grey');
    })
    .filter('rawHtml', ['$sce', function($sce){
        return function(val) {
            return $sce.trustAsHtml(val);
        };
    }]);