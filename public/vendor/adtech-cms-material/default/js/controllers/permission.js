'use strict';
angular
    .module("AdtechApp")
    .controller('permissionCtrl', permissionCtrl);

function permissionCtrl($rootScope, $scope, $location, $mdDialog, $http) {
    $scope.packages = packages;
    $scope.modules = modules;
    if(typeof filter_package.slug == 'undefined')
        $scope.filter_package;
    else
        $scope.filter_package = filter_package;

    if(typeof filter_module.slug == 'undefined')
        $scope.filter_module;
    else
        $scope.filter_module = filter_module;

    $scope.filterChange = function () {
        var params = [];
        if ($scope.filter_package !== undefined) {
            params.push('package=' + $scope.filter_package.slug);
        }
        if($scope.filter_module !== undefined) {
            params.push('module=' + $scope.filter_module.slug);
        }
        if(params.length > 0){
            var path = $location.path();
            var url = path;
            AdtechApp.loading.show();
            window.location.href = (url + '?' + params.join('&'));
        }
    }
    $scope.filterChangeP = function () {
        if ($scope.filter_package !== undefined) {
            return $scope.filter_package.name;
        } else {
            return "Package";
        }
    }
    $scope.filterChangeM = function () {
        if ($scope.filter_module !== undefined) {
            return $scope.filter_module.name;
        } else {
            return "Module";
        }
    }
    $scope.editForm = function (ev, type, id) {
        if(type=='user'){
            $http({
                method: 'GET',
                url: urlshowuser,
                params: {id: id}
            }).then(function successCallback(response) {
                // this callback will be called asynchronously
                // when the response is available
                var parentEl = angular.element(document.body);
                $mdDialog.show({
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
                        $scope.updateRole = function() {
                            $http({
                                method: 'POST',
                                url: urlupdateuser,
                                headers: {'Content-Type': 'application/json; charset=UTF-8'},
                                data: {
                                    user_id: $scope.user.user_id,
                                    email: $scope.user.email,
                                    first_name: $scope.user.first_name,
                                    last_name: $scope.user.last_name,
                                    activated: $scope.user.activated,
                                    status: $scope.user.status,
                                    permission_locked: $scope.user.permission_locked,
                                    role_id: $scope.user.role_id,
                                    change_pass: $scope.user.showChangePass,
                                    password: $scope.user.password,
                                    password_confirmation: $scope.user.password_confirmation,
                                }
                            }).success(function (response) {
                                $rootScope.txt.title = 'User: '+response.email;
                                console.log(response);
                                if(response.success==true) {
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
                                            .textContent('Cập nhật không thành công')
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
        }
        else{
            if(type=='role'){
                $http({
                    method: 'GET',
                    url: urlshowrole,
                    params: {id: id}
                }).then(function successCallback(response) {
                    // this callback will be called asynchronously
                    // when the response is available
                    var parentEl = angular.element(document.body);
                    $mdDialog.show({
//                contentElement: '#myDialog',
                        templateUrl: 'frm-edit-role',
                        parent: parentEl,
                        targetEvent: ev,
                        clickOutsideToClose: false,
                        locals: {
                            items: response.data
                        },
                        controller: function ($scope, $mdDialog, $mdToast, items) {
                            $scope.role = items;
                            $scope.updateRole = function() {
                                $http({
                                    method: 'POST',
                                    url: urlupdaterole,
                                    headers: {'Content-Type': 'application/json; charset=UTF-8'},
                                    data: {
                                        role_id: $scope.role.role_id,
                                        name: $scope.role.name
                                    }
                                }).success(function (response) {
                                    $rootScope.txt.title = 'Role: '+response.name;
                                    console.log(response);
                                    if(response.success==true) {
                                        $mdToast.show(
                                            $mdToast.simple()
                                                .textContent('Cập nhật thành công Role: ' + response.name)
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
            }
        }
    }
}