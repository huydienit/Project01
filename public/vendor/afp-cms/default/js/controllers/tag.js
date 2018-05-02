'use strict';
angular
    .module("AdtechApp")
    .controller('tagCtrl', tagCtrl);

function tagCtrl($scope, $mdDialog, $http, $mdToast, removeByAttr) {
    $scope.addItem = function (ev) {
        var parentEl = angular.element(document.body);
        $mdDialog.show({
//                contentElement: '#myDialog',
            templateUrl: 'frm-add-tag',
            parent: parentEl,
            targetEvent: ev,
            clickOutsideToClose: false,
            controller: function ($scope, $mdDialog, $mdToast) {
                $scope.addTag = function() {
                    $http({
                        method: 'POST',
                        url: 'add',
                        headers: {'Content-Type': 'application/json; charset=UTF-8'},
                        data: {
                            name: $scope.tag.name
                        }
                    }).success(function (response) {
                        console.log(response);
                        if(response.success==true) {
                            coreTags.push(response);
                            coreTags.sort(removeByAttr.sort);
                            $mdToast.show(
                                $mdToast.simple()
                                    .textContent('Thêm thành công tag: ' + response.name)
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
                templateUrl: 'frm-edit-tag',
                parent: parentEl,
                targetEvent: ev,
                clickOutsideToClose: false,
                locals: {
                    items: response.data
                },
                controller: function ($scope, $mdDialog, $mdToast, items) {
                    $scope.tag = items;
                    $scope.updateTag = function() {
                        $http({
                            method: 'POST',
                            url: 'update',
                            headers: {'Content-Type': 'application/json; charset=UTF-8'},
                            data: {
                                id: $scope.tag.id,
                                name: $scope.tag.name
                            }
                        }).success(function (response) {
                            console.log(response);
                            if(response.success==true){
                                removeByAttr.func(coreTags, 'id', response.id);
                                coreTags.push(response);
                                coreTags.sort(removeByAttr.sort);
                                $mdToast.show(
                                    $mdToast.simple()
                                        .textContent('Cập nhật thành công tag: ' + response.name)
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
                                    removeByAttr.func(coreTags, 'id', id);
                                    $mdToast.show(
                                        $mdToast.simple()
                                            .textContent('Xoá thành công tag: ' + response.name)
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
                    removeByAttr.func(coreTags, 'id', id);
                    $mdToast.show(
                        $mdToast.simple()
                            .textContent('Xoá thành công tag: ' + response.name)
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