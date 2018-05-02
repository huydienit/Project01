'use strict';
angular
    .module("AdtechApp")
    .controller('zoneCpcCtrl', zoneCpcCtrl);

function zoneCpcCtrl($scope, $mdDialog, $http, $mdToast, removeByAttr, $q, $timeout) {
    $scope.onChangeStatus = function (status, id) {
        $http({
            method: 'POST',
            url: 'status',
            headers: {'Content-Type': 'application/json; charset=UTF-8'},
            data: {
                zonecpc_id: id,
                status: (status == 1) ? false : true
            }
        }).success(function (response) {
            console.log(response);
            if (response.success == true) {
                removeByAttr.func(coreItem, 'id', response.id);
                coreItem.push(response);
                coreItem.sort(removeByAttr.sort);
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Cập nhật thành công zone: ' + response.name)
                        .theme("success-toast")
                        .position('top right')
                        .action('⛌')
                );
            }
            else {
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
            templateUrl: 'frm-add-item',
            parent: parentEl,
            targetEvent: ev,
            clickOutsideToClose: false,
            controller: function ($scope, $mdDialog, $mdToast) {
                $scope.boxFormatList = boxFormatList;
                $scope.zoneTemplateList = zoneTemplateList;
                $scope.addZoneCpc = function () {
                    $http({
                        method: 'POST',
                        url: 'add',
                        headers: {'Content-Type': 'application/json; charset=UTF-8'},
                        data: {
                            site_id: site_id,
                            box_format_id: $scope.item.box_format_id,
                            zone_template_id: $scope.item.zone_template_id,
                            notes: $scope.item.notes,
                            status: $scope.item.statusLB,
                            hiddenLabel: $scope.item.hiddenLabelLB,
                        }
                    }).success(function (response) {
                        console.log(response);
                        if (response.success == true) {
                            coreItem.push(response);
                            coreItem.sort(removeByAttr.sort);
                            $mdToast.show(
                                $mdToast.simple()
                                    .textContent('Thêm thành công zone: ' + response.name)
                                    .theme("success-toast")
                                    .position('top right')
                                    .action('⛌')
                            );
                        }
                        else {
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
                $scope.closeDialog = function () {
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
                    console.log(items);
                    $scope.item = items;
                    $scope.boxFormatList = boxFormatList;
                    $scope.zoneTemplateList = zoneTemplateList;
                    $scope.updateZoneCpc = function () {
                        $http({
                            method: 'POST',
                            url: 'update',
                            headers: {'Content-Type': 'application/json; charset=UTF-8'},
                            data: {
                                site_id: site_id,
                                zonecpc_id: $scope.item.zonecpc_id,
                                box_format_id: $scope.item.box_format_id,
                                zone_template_id: $scope.item.zone_template_id,
                                notes: $scope.item.notes,
                                status: $scope.item.statusLB,
                                hiddenLabel: $scope.item.hiddenLabelLB,
                            }
                        }).success(function (response) {
                            console.log(response);
                            if (response.success == true) {
                                removeByAttr.func(coreItem, 'id', response.id);
                                coreItem.push(response);
                                coreItem.sort(removeByAttr.sort);
                                $mdToast.show(
                                    $mdToast.simple()
                                        .textContent('Cập nhật thành công zone: ' + response.name)
                                        .theme("success-toast")
                                        .position('top right')
                                        .action('⛌')
                                );
                            }
                            else {
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

                        $mdDialog.show(confirm).then(function () {
                            $http({
                                method: 'POST',
                                url: 'delete',
                                headers: {'Content-Type': 'application/json; charset=UTF-8'},
                                data: {
                                    id: id
                                }
                            }).success(function (response) {
                                if (response.success == true) {
                                    removeByAttr.func(coreItem, 'id', response.id);
                                    $mdToast.show(
                                        $mdToast.simple()
                                            .textContent('Xoá thành công zone: ' + response.name)
                                            .theme("success-toast")
                                            .position('top right')
                                            .action('⛌')
                                    );
                                }
                                else {
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
                    $scope.closeDialog = function () {
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
                .show(alert)
                .finally(function () {
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

        $mdDialog.show(confirm).then(function () {
            $http({
                method: 'POST',
                url: 'delete',
                headers: {'Content-Type': 'application/json; charset=UTF-8'},
                data: {
                    id: id
                }
            }).success(function (response) {
                console.log(response);
                if (response.success == true) {
                    removeByAttr.func(coreItem, 'id', id);
                    $mdToast.show(
                        $mdToast.simple()
                            .textContent('Xoá thành công zone: ' + response.name)
                            .theme("success-toast")
                            .position('top right')
                            .action('⛌')
                    );
                }
                else {
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