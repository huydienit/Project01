'use strict';
angular
    .module("AdtechApp")
    .controller('paymentCtrl', paymentCtrl)
    .directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;

                element.bind('change', function () {
                    scope.$apply(function () {
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }]);

function paymentCtrl($rootScope, $scope, $mdDialog, $http, $mdToast, fileUpload) {
    $scope.checkUploadFile = false;
    $scope.selectFile = function (ev) {
        var myFile = document.getElementById("myFile");
        var filename = myFile.value.replace(/^.*[\\\/]/, '')
        var confirm = $mdDialog.confirm()
            .title('Bạn có chắc chắn thực hiện thao tác này?')
            .textContent('Thông tin thanh toán sẽ được cập nhật theo file bạn upload: '+filename)
            .ariaLabel('Payment upload')
            .targetEvent(ev)
            .ok('Xác nhận')
            .cancel('Hủy cập nhật');

        if ("" != myFile.value) {
            $mdDialog.show(confirm).then(function () {
                // $scope.checkUploadFile = true;
                $scope.myFile = document.getElementById('myFile').files[0];
                $scope.uploadFile();
            }, function () {
                $scope.checkUploadFile = false;
                myFile.value= null;
            });
        }
        else {
            $scope.checkUploadFile = false;
            myFile.value= null;
        }
    };
    $scope.uploadFile = function () {
        var file = $scope.myFile;
        var uploadUrl = "upload";
        fileUpload.uploadFileToUrl(file, uploadUrl);
    };
}