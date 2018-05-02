'use strict';
angular
    .module("AdtechApp")
    .controller('reportCtrl', reportCtrl);

function reportCtrl($rootScope, $scope, $mdDialog, $http, $mdToast, removeByAttr) {
    $scope.exportSite = function () {
        var query = $rootScope.query;
        $http({
            method: 'POST',
            url: 'report/exportSite',
            headers: {'Content-Type': 'application/json; charset=UTF-8'},
            data: {
                keyword: query.keyword,
                status: query.status,
                category: query.category,
                tag: query.tag,
                begin: query.begin,
                end: query.end
            }
        }).success(function (response) {
            console.log(response);
            if (response.success == true) {
                document.location.href = (response.url);
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Xuất file thành công')
                        .theme("success-toast")
                        .position('top right')
                        .action('⛌')
                );
            }
            else {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Xuất file không thành công')
                        .theme("error-toast")
                        .position('top right')
                        .action('⛌')
                );
            }
        });
    }

    $scope.exportZone = function () {
        var query = $rootScope.query;
        $http({
            method: 'POST',
            url: 'report/exportZone',
            headers: {'Content-Type': 'application/json; charset=UTF-8'},
            data: {
                keyword: query.keyword,
                status: query.status,
                category: query.category,
                tag: query.tag,
                begin: query.begin,
                end: query.end
            }
        }).success(function (response) {
            console.log(response);
            if (response.success == true) {
                document.location.href = (response.url);
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Xuất file thành công')
                        .theme("success-toast")
                        .position('top right')
                        .action('⛌')
                );
            }
            else {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Xuất file không thành công')
                        .theme("error-toast")
                        .position('top right')
                        .action('⛌')
                );
            }
        });
    }
}