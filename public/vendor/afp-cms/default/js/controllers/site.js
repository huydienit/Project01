'use strict';
angular
    .module("AdtechApp")
    .controller('siteCtrl', siteCtrl);

function siteCtrl($scope, $mdDialog, $http, $mdToast, removeByAttr) {
    $scope.onChangeStatus = function(site_status, site_id){
        $http({
            method: 'POST',
            url: 'status',
            headers: {'Content-Type': 'application/json; charset=UTF-8'},
            data: {
                site_id: site_id,
                site_status: (site_status==1)?false:true
            }
        }).success(function (response) {
            console.log(response);
            if(response.success==true) {
                removeByAttr.func(coreSite, 'id', response.site_id);
                coreSite.push(response);
                coreSite.sort(removeByAttr.sort);
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Cập nhật thành công Site: ' + response.sitename)
                        .theme("success-toast")
                        .position('top right')
                        .action('⛌')
                );
            }
            else{
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Update không thành công: ' + Object.values(response)[0][0])
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
            templateUrl: 'frm-add-site',
            parent: parentEl,
            targetEvent: ev,
            clickOutsideToClose: false,
            controller: function ($scope, $mdDialog, $mdToast) {
                $scope.categoryList = categoryList;
                $scope.tagList = tagList;
                $scope.addSite = function() {
                    $http({
                        method: 'POST',
                        url: 'add',
                        headers: {'Content-Type': 'application/json; charset=UTF-8'},
                        data: {
                            status: $scope.site.statusLB,
                            sitename: $scope.site.sitename,
                            username: $scope.site.username,
                            price_sale: $scope.site.price_sale,
                            price_buy: $scope.site.price_buy,
                            category_id: $scope.site.category,
                            visits: $scope.site.visits,
                            pageviews: $scope.site.pageviews,
                            rank_country: $scope.site.rank_country,
                            tag: $scope.site.tags,
                        }
                    }).success(function (response) {
                        console.log(response);
                        if(response.success==true) {
                            coreSite.push(response);
                            coreSite.sort(removeByAttr.sort);
                            $mdToast.show(
                                $mdToast.simple()
                                    .textContent('Thêm thành công Site: ' + response.sitename)
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
    $scope.showEdit = function (site_id) {
        $http({
            method: 'GET',
            url: 'show',
            params: {site_id: site_id}
        }).then(function successCallback(response) {
            // this callback will be called asynchronously
            // when the response is available
            console.log(response);
            var parentEl = angular.element(document.body);
            $mdDialog.show({
//                contentElement: '#myDialog',
                templateUrl: 'frm-edit-site',
                parent: parentEl,
                // targetEvent: ev,
                clickOutsideToClose: false,
                locals: {
                    items: response.data
                },
                controller: function ($scope, $mdDialog, $mdToast, items) {
                    $scope.site = items;
                    $scope.categoryList = categoryList;
                    $scope.tagList = tagList;
                    $scope.updateSite = function() {
                        $http({
                            method: 'POST',
                            url: 'update',
                            headers: {'Content-Type': 'application/json; charset=UTF-8'},
                            data: {
                                site_id: $scope.site.site_id,
                                status: $scope.site.statusLB,
                                cpcstatus: $scope.site.cpcstatusLB,
                                cpcreport: $scope.site.cpcreportLB,
                                // adxstatus: $scope.site.adxstatusLB,
                                // adxreport: $scope.site.adxreportLB,
                                sitename: $scope.site.sitename,
                                username: $scope.site.username,
                                price_sale: $scope.site.price_sale,
                                price_buy: $scope.site.price_buy,
                                category_id: $scope.site.category,
                                visits: $scope.site.visits,
                                pageviews: $scope.site.pageviews,
                                rank_country: $scope.site.rank_country,
                                tag: $scope.site.tags,
                            }
                        }).success(function (response) {
                            console.log(response);
                            if(response.success==true){
                                removeByAttr.func(coreSite, 'id', response.site_id);
                                coreSite.push(response);
                                coreSite.sort(removeByAttr.sort);
                                $mdToast.show(
                                    $mdToast.simple()
                                        .textContent('Cập nhật thành công Site: ' + response.sitename)
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
                    $scope.showDel = function (ev, site_id) {
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
                                    site_id: site_id
                                }
                            }).success(function (response) {
                                console.log(response);
                                if(response.success==true) {
                                    removeByAttr.func(coreSite, 'id', site_id);
                                    $mdToast.show(
                                        $mdToast.simple()
                                            .textContent('Xoá thành công Site: ' + response.sitename)
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

    if (edit == 1) {
        $scope.showEdit(site_id);
    }

    $scope.showDel = function (ev, site_id) {
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
                    site_id: site_id
                }
            }).success(function (response) {
                console.log(response);
                if(response.success==true) {
                    removeByAttr.func(coreSite, 'id', site_id);
                    $mdToast.show(
                        $mdToast.simple()
                            .textContent('Xoá thành công Site: ' + response.sitename)
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
}