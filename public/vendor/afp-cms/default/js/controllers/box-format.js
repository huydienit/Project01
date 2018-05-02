'use strict';
angular
    .module("AdtechApp")
    .controller('boxFormatCtrl', boxFormatCtrl);

function boxFormatCtrl($scope, $mdDialog, $http, $mdToast, removeByAttr) {
    $scope.addItem = function (ev) {
        var parentEl = angular.element(document.body);
        $mdDialog.show({
//                contentElement: '#myDialog',
            templateUrl: 'frm-add-box',
            parent: parentEl,
            targetEvent: ev,
            clickOutsideToClose: false,
            controller: function ($scope, $mdDialog, $mdToast) {
                $scope.addBox = function() {
                    $http({
                        method: 'POST',
                        url: 'add',
                        headers: {'Content-Type': 'application/json; charset=UTF-8'},
                        data: {
                            name: $scope.box.name,
                            description: $scope.box.description
                        }
                    }).success(function (response) {
                        console.log(response);
                        if(response.success==true) {
                            coreBox.push(response);
                            coreBox.sort(removeByAttr.sort);
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
                templateUrl: 'frm-edit-box',
                parent: parentEl,
                targetEvent: ev,
                clickOutsideToClose: false,
                locals: {
                    items: response.data
                },
                controller: function ($scope, $mdDialog, $mdToast, items) {
                    $scope.box = items;
                    $scope.updateBox = function() {
                        $http({
                            method: 'POST',
                            url: 'update',
                            headers: {'Content-Type': 'application/json; charset=UTF-8'},
                            data: {
                                id: $scope.box.id,
                                name: $scope.box.name,
                                description: $scope.box.description
                            }
                        }).success(function (response) {
                            console.log(response);
                            if(response.success==true){
                                removeByAttr.func(coreBox, 'id', response.id);
                                coreBox.push(response);
                                coreBox.sort(removeByAttr.sort);
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
                                    removeByAttr.func(coreBox, 'id', id);
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
                    removeByAttr.func(coreBox, 'id', id);
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