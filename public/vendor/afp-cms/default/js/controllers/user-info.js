'use strict';
angular
    .module("AdtechApp")
    .controller('userCtrl', userCtrl);

function userCtrl($scope, $mdDialog, $http, $mdToast, removeByAttr) {
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
                    $scope.typeList = typeList;
                    $scope.provinceList = provinceList;
                    $scope.updateUser = function() {
                        $http({
                            method: 'POST',
                            url: 'update',
                            headers: {'Content-Type': 'application/json; charset=UTF-8'},
                            data: {
                                user_id: $scope.user.user_id,
                                contact_name: $scope.user.contact_name,
                                contact_type: $scope.user.contact_type,
                                contact_email: $scope.user.contact_email,
                                contact_phone: $scope.user.contact_phone,
                                contact_address: $scope.user.contact_address,
                                contact_bank_name: $scope.user.contact_bank_name,
                                contact_branch_name: $scope.user.contact_branch_name,
                                contact_stk: $scope.user.contact_stk,
                                contact_cmt: $scope.user.contact_cmt,
                                contact_noicap: $scope.user.contact_noicap,
                                contact_email_cc: $scope.user.contact_email_cc,
                                contact_manager_name: $scope.user.contact_manager_name,
                                contact_website: $scope.user.contact_website,
                                contact_sohopdong: $scope.user.contact_sohopdong,
                                contact_masothue: $scope.user.contact_masothue,
                                contact_status: $scope.user.contact_statusLB,
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
};