<md-button class="md-fab md-fab-bottom-right docs-scroll-fab"
           adtech-scroll-class="scrolling"
           ng-click="scrollTop()"
           aria-label="{{ $labelBackToTop = trans('adtech-core::common.back_to_top') }}">
    <md-tooltip md-direction="top">{{ $labelBackToTop }}</md-tooltip>
    <md-icon class="md-default-theme" class="material-icons">expand_less</md-icon>
</md-button>

<footer layout="column" layout-align="end">
    <footer-content layout="row" layout-align="start center" layout-wrap>
        <div layout="row" layout-align="start center">
            <span>{{ config('app.name') }}</span>
        </div>
        <div layout="row" layout-align="start center">
            <div>{{ __('adtech-core::labels.version_short') }}{{ config('site.version') }}</div>
        </div>
    </footer-content>
</footer>
@include('includes.loading')
@if (Session::has('flash_messenger'))
    <div ng-controller="FlashMessageController"></div>
    @push('scripts-footer')
    <script type="text/ng-template" id="flash-messenger-template.html">
        <md-toast class="md-success-toast-theme">
            <span class="md-toast-text" flex>{{ Session::get('flash_messenger') }}</span>
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