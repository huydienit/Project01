'use strict';
angular
    .module("AdtechApp")
    .controller('homeCtrl', homeCtrl);
function homeCtrl($scope, $http, $mdDialog, $mdToast, removeByAttr) {
    $scope.sitedk = listSiteDK;
    $scope.siteEmpty = listSiteEmpty;
    $scope.query = {
        limit: limit,
        page: 1,
        total: total
    };
    $scope.getSiteDK = function (ev) {
        var query = $scope.query;
        $http({
            method: 'GET',
            url: '/admin/afp/core/site/getsitedk',
            params: {page: query.page, limit: query.limit}
        }).then(function successCallback(response) {
            console.log(response);
            $scope.sitedk = response.data;
        })
    };
    $scope.onChangeStatusDK = function (ev, site_id) {
        $http({
            method: 'GET',
            url: '/admin/afp/core/site/show',
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
                targetEvent: ev,
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
                            url: '/admin/afp/core/site/update',
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
                                tag: $scope.site.tags,
                            }
                        }).success(function (response) {
                            console.log(response);
                            if(response.success==true){
                                removeByAttr.func(listSiteDK, 'id', response.site_id);
                                listSiteDK.push(response);
                                listSiteDK.sort(removeByAttr.sort);
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
                                        .textContent('Cập nhật không thành công')
                                        .theme("error-toast")
                                        .position('top right')
                                        .action('⛌')
                                );
                            }
                            $mdDialog.hide();
                        });
                    };
                    $scope.showDel = function (ev, site_id, sitename) {
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
                                url: '/admin/afp/core/site/delete',
                                headers: {'Content-Type': 'application/json; charset=UTF-8'},
                                data: {
                                    site_id: site_id,
                                    sitename: sitename
                                }
                            }).success(function (response) {
                                console.log(response);
                                if(response.success==true) {
                                    removeByAttr.func(listSiteDK, 'id', site_id);
                                    $mdToast.show(
                                        $mdToast.simple()
                                            .textContent('Xoá thành công User: ' + sitename)
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
    }
}

$('#container').highcharts({
    chart: {
        height: '415px',
        style: {
            fontFamily: 'Roboto, "Helvetica Neue", sans-serif'
        }
    },
    legend: {
        itemWidth: 100
    },
    credits: {
        enabled: false
    },
    title: {
        text: 'Báo cáo hiệu suất',
        align: 'left'
    },
    xAxis: {
        categories: categories
    },
    yAxis: {
        title: {
            text: ''
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    series: chartData
});

$('#container').highcharts().setSize(
    ($(document).width()<600)?$(document).width()-68:$(document).width()/2-68,
    415,
    false
);
$(window).resize(function()
{
    $('#container').highcharts().setSize(
        ($(document).width()<600)?$(document).width()-68:$(document).width()/2-68,
        415,
        false
    );
});