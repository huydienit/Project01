'use strict';
angular
    .module("AdtechApp")
    .controller('userCtrl', userCtrl);

function userCtrl($scope, $mdDialog, $http, $mdToast, removeByAttr) {
    $scope.onChangeStatus = function(status, id){
        $http({
            method: 'POST',
            url: 'status',
            headers: {'Content-Type': 'application/json; charset=UTF-8'},
            data: {
                user_id: id,
                status: (status==1)?false:true
            }
        }).success(function (response) {
            console.log(response);
            if(response.success==true) {
                removeByAttr.func(coreUsers, 'id', response.id);
                coreUsers.push(response);
                coreUsers.sort(removeByAttr.sort);
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Cập nhật thành công User: ' + response.email)
                        .theme("success-toast")
                        .position('top right')
                        .action('⛌')
                );
            }
            else{
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Update không thành công')
                        .theme("error-toast")
                        .position('top right')
                        .action('⛌')
                );
            }
        });
    }
    $scope.addItem = function (ev) {
        var parentEl = angular.element(document.body);
        $mdDialog.show({
//                contentElement: '#myDialog',
            templateUrl: 'frm-add-user',
            parent: parentEl,
            targetEvent: ev,
            clickOutsideToClose: false,
            controller: function ($scope, $mdDialog, $mdToast) {
                $scope.roleLists = roleList;
                $scope.addUser = function() {
                    $http({
                        method: 'POST',
                        url: 'add',
                        headers: {'Content-Type': 'application/json; charset=UTF-8'},
                        data: {
                            activated: $scope.user.activatedLB,
                            contact_name: $scope.user.contact_name,
                            email: $scope.user.email,
                            password: $scope.user.password,
                            password_confirmation: $scope.user.password_confirmation,
                            permission_locked: $scope.user.permission_lockedLB,
                            role_id: $scope.user.role_id,
                            status: $scope.user.statusLB,
                            username: $scope.user.username,
                        }
                    }).success(function (response) {
                        console.log(response);
                        if(response.success==true) {
                            coreUsers.push(response);
                            coreUsers.sort(removeByAttr.sort);
                            $mdToast.show(
                                $mdToast.simple()
                                    .textContent('Thêm thành công User: ' + response.email)
                                    .theme("success-toast")
                                    .position('top right')
                                    .action('⛌')
                            );
                        }
                        else{
                            $mdToast.show(
                                $mdToast.simple()
                                    .textContent('Thêm không thành công: ' + Object.values(response)[0][0])
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
            console.log(response);
            var parentEl = angular.element(document.body);
            $mdDialog.show({
//                contentElement: '#myDialog',
                templateUrl: 'frm-edit-user',
                parent: parentEl,
                targetEvent: ev,
                clickOutsideToClose: false,
                locals: {
                    items: response.data
                },
                controller: function ($scope, $mdDialog, $mdToast, items) {
                    $scope.user = items;
                    $scope.roleLists = roleList;
                    $scope.updateUser = function() {
                        $http({
                            method: 'POST',
                            url: 'update',
                            headers: {'Content-Type': 'application/json; charset=UTF-8'},
                            data: {
                                activated: $scope.user.activatedLB,
                                change_pass: $scope.user.showChangePass,
                                contact_name: $scope.user.contact_name,
                                email: $scope.user.email,
                                password: $scope.user.password,
                                password_confirmation: $scope.user.password_confirmation,
                                permission_locked: $scope.user.permission_lockedLB,
                                role_id: $scope.user.role_id,
                                status: $scope.user.statusLB,
                                user_id: $scope.user.user_id,
                                username: $scope.user.username,
                            }
                        }).success(function (response) {
                            console.log(response);
                            if(response.success==true){
                                removeByAttr.func(coreUsers, 'id', response.id);
                                coreUsers.push(response);
                                coreUsers.sort(removeByAttr.sort);
                                $mdToast.show(
                                    $mdToast.simple()
                                        .textContent('Cập nhật thành công User: ' + response.email)
                                        .theme("success-toast")
                                        .position('top right')
                                        .action('⛌')
                                );
                            }
                            else{
                                $mdToast.show(
                                    $mdToast.simple()
                                        .textContent('Cập nhật không thành công: ' + Object.values(response)[0][0])
                                        .theme("error-toast")
                                        .position('top right')
                                        .action('⛌')
                                );
                            }
                            $mdDialog.hide();
                        });
                    };
                    $scope.showDel = function (ev, id, email) {
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
                                    user_id: id,
                                    email: email
                                }
                            }).success(function (response) {
                                console.log(response);
                                if(response.success==true) {
                                    removeByAttr.func(coreUsers, 'id', id);
                                    $mdToast.show(
                                        $mdToast.simple()
                                            .textContent('Xoá thành công User: ' + response.email)
                                            .theme("success-toast")
                                            .position('top right')
                                            .action('⛌')
                                    );
                                }
                                else{
                                    $mdToast.show(
                                        $mdToast.simple()
                                            .textContent('Xoá không thành công: ' + Object.values(response)[0][0])
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
    $scope.showDel = function (ev, id, email) {
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
                    user_id: id,
                    email: email
                }
            }).success(function (response) {
                console.log(response);
                if(response.success==true) {
                    removeByAttr.func(coreUsers, 'id', id);
                    $mdToast.show(
                        $mdToast.simple()
                            .textContent('Xoá thành công User: ' + response.email)
                            .theme("success-toast")
                            .position('top right')
                            .action('⛌')
                    );
                }
                else{
                    $mdToast.show(
                        $mdToast.simple()
                            .textContent('Xoá không thành công: ' + Object.values(response)[0][0])
                            .theme("error-toast")
                            .position('top right')
                            .action('⛌')
                    );
                }
            });
        });
    };
};