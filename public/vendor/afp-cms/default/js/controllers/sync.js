'use strict';
angular
    .module("AdtechApp")
    .controller('syncCtrl', syncCtrl);

function syncCtrl($scope, $http) {
    $scope.syncList = [{
        id: 1,
        name: 'Category'
    },{
        id: 2,
        name: 'Tag'
    },{
        id: 3,
        name: 'Box format'
    },{
        id: 4,
        name: 'Zone template'
    },{
        id: 5,
        name: 'Channel'
    }];
    $scope.selected = [];
    $scope.syncData = function () {
        $http({
            method: 'POST',
            url: 'syncdata',
            headers: {'Content-Type': 'application/json; charset=UTF-8'},
            data: {
                data: $scope.selected,
            }
        }).success(function (response) {
            console.log(response);
        });
    }

    $scope.toggle = function (item, list) {
        var idx = list.indexOf(item);
        if (idx > -1) {
            list.splice(idx, 1);
        }
        else {
            list.push(item);
        }
    };

    $scope.exists = function (item, list) {
        return list.indexOf(item) > -1;
    };
};