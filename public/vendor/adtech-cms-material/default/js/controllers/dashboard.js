'use strict';
angular
    .module("AdtechApp")
    .controller('homeCtrl', homeCtrl);
function homeCtrl($scope) {
    $scope.sitedk = listSiteDK;
    $scope.siteadx = listSiteADX;
}