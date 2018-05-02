@include('includes.loading')
@if (Session::has('flash_messenger') || Session::has('message'))
    <div ng-controller="FlashMessageController"></div>
    @push('scripts-footer')
    <script type="text/ng-template" id="flash-messenger-template.html">
        <md-toast class="md-success-toast-theme">
            @if (Session::has('flash_messenger'))
                <span class="md-toast-text" flex>{{ Session::get('flash_messenger') }}</span>
            @elseif (Session::has('message'))
                <span class="md-toast-text" flex>{{ Session::get('message') }}</span>
            @endif
            <md-button ng-click="closeToast()">
                {{ __('adtech-core::buttons.close_icon') }}
            </md-button>
        </md-toast>
    </script>
    <script>
        (function () {
            angular
                .module('AdtechApp')
                .controller('FlashMessageController', function ($scope, $mdToast) {
                    $mdToast.show({
                        hideDelay: 3000,
                        position: 'top right',
                        controller: 'MessageController',
                        templateUrl: 'flash-messenger-template.html',
                        theme: 'success-toast'
                    });
                })
                .controller('MessageController', function ($scope, $mdToast) {
                    $scope.closeToast = function () {
                        $mdToast.hide();
                    };
                });
        })();
    </script>
    @endpush
@endif