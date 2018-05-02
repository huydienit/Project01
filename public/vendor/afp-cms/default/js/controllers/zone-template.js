'use strict';
angular
    .module("AdtechApp")
    .controller('zoneTemplateCtrl', zoneTemplateCtrl);

function zoneTemplateCtrl($scope, $mdDialog, $http, $mdToast, removeByAttr) {
    $scope.addItem = function (ev) {
        var parentEl = angular.element(document.body);
        $mdDialog.show({
//                contentElement: '#myDialog',
            templateUrl: 'frm-add-item',
            parent: parentEl,
            targetEvent: ev,
            clickOutsideToClose: false,
            controller: function ($scope, $mdDialog, $mdToast) {
                $scope.addZone = function() {
                    $http({
                        method: 'POST',
                        url: 'add',
                        headers: {'Content-Type': 'application/json; charset=UTF-8'},
                        data: {
                            name: $scope.item.name,
                            code: $scope.item.code
                        }
                    }).success(function (response) {
                        console.log(response);
                        if(response.success==true) {
                            coreItem.push(response);
                            coreItem.sort(removeByAttr.sort);
                            $mdToast.show(
                                $mdToast.simple()
                                    .textContent('Thêm thành công box format: ' + response.name)
                                    .theme("success-toast")
                                    .position('top right')
                                    .action('⛌')
                            );
                        }
                        else{
                            $mdToast.show(
                                $mdToast.simple()
                                    .textContent('Thêm không thành công')
                                    .theme("error-toast")
                                    .position('top right')
                                    .action('⛌')
                            );
                        }
                        $mdDialog.hide();
                    });
                };
                $scope.closeDialog = function() {
                    $mdDialog.hide();
                };
            }
        });
    };
    $scope.showEdit = function (ev, id) {
        $http({
            method: 'GET',
            url: 'show',
            params: {id: id}
        }).then(function successCallback(response) {
            // this callback will be called asynchronously
            // when the response is available
            var parentEl = angular.element(document.body);
            $mdDialog.show({
//                contentElement: '#myDialog',
                templateUrl: 'frm-edit-item',
                parent: parentEl,
                targetEvent: ev,
                clickOutsideToClose: false,
                locals: {
                    items: response.data
                },
                controller: function ($scope, $mdDialog, $mdToast, items) {
                    $scope.item = items;
                    $scope.updateZone = function() {
                        $http({
                            method: 'POST',
                            url: 'update',
                            headers: {'Content-Type': 'application/json; charset=UTF-8'},
                            data: {
                                id: $scope.item.id,
                                name: $scope.item.name,
                                code: $scope.item.code
                            }
                        }).success(function (response) {
                            console.log(response);
                            if(response.success==true){
                                removeByAttr.func(coreItem, 'id', response.id);
                                coreItem.push(response);
                                coreItem.sort(removeByAttr.sort);
                                $mdToast.show(
                                    $mdToast.simple()
                                        .textContent('Cập nhật thành công box format: ' + response.name)
                                        .theme("success-toast")
                                        .position('top right')
                                        .action('⛌')
                                );
                            }
                            else{
                                $mdToast.show(
                                    $mdToast.simple()
                                        .textContent('Cập nhật không thành công')
                                        .theme("error-toast")
                                        .position('top right')
                                        .action('⛌')
                                );
                            }
                            $mdDialog.hide();
                        });
                    };
                    $scope.showDel = function (ev, id) {
                        var confirm = $mdDialog.confirm()
                            .title('Bạn thực sự muốn xoá?')
                            .textContent('......')
                            .ariaLabel('...')
                            .targetEvent(ev)
                            .ok('Xác nhận')
                            .cancel('Huỷ');

                        $mdDialog.show(confirm).then(function() {
                            $http({
                                method: 'POST',
                                url: 'delete',
                                headers: {'Content-Type': 'application/json; charset=UTF-8'},
                                data: {
                                    id: id
                                }
                            }).success(function (response) {
                                console.log(response);
                                if(response.success==true){
                                    removeByAttr.func(coreItem, 'id', id);
                                    $mdToast.show(
                                        $mdToast.simple()
                                            .textContent('Xoá thành công box format: ' + response.name)
                                            .theme("success-toast")
                                            .position('top right')
                                            .action('⛌')
                                    );
                                }
                                else{
                                    $mdToast.show(
                                        $mdToast.simple()
                                            .textContent('Xoá không thành công')
                                            .theme("error-toast")
                                            .position('top right')
                                            .action('⛌')
                                    );
                                }
                            });
                        });
                    };
                    $scope.closeDialog = function() {
                        $mdDialog.hide();
                    };
                }
            });
        }, function errorCallback($mdDialog) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            var alert = $mdDialog.alert({
                title: 'Error',
                textContent: 'Have an error!',
                ok: 'Close'
            });
            $mdDialog
                .show( alert )
                .finally(function() {
                    alert = undefined;
                });
        });
    };
    $scope.showDel = function (ev, id) {
        var confirm = $mdDialog.confirm()
            .title('Bạn thực sự muốn xoá?')
            .textContent('......')
            .ariaLabel('...')
            .targetEvent(ev)
            .ok('Xác nhận')
            .cancel('Huỷ');

        $mdDialog.show(confirm).then(function() {
            $http({
                method: 'POST',
                url: 'delete',
                headers: {'Content-Type': 'application/json; charset=UTF-8'},
                data: {
                    id: id
                }
            }).success(function (response) {
                console.log(response);
                if(response.success==true){
                    removeByAttr.func(coreItem, 'id', id);
                    $mdToast.show(
                        $mdToast.simple()
                            .textContent('Xoá thành công box format: ' + response.name)
                            .theme("success-toast")
                            .position('top right')
                            .action('⛌')
                    );
                }
                else{
                    $mdToast.show(
                        $mdToast.simple()
                            .textContent('Xoá không thành công')
                            .theme("error-toast")
                            .position('top right')
                            .action('⛌')
                    );
                }
            });
        });
    };
};