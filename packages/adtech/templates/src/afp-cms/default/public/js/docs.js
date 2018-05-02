AdtechApp = AdtechApp || [];
AdtechApp.loading = {
    _elements: {
        container: null,
        overlay: null
    },
    init: function () {
        var self = this;
        if (self._elements.container == null) {
            self._elements.container = document.getElementById('loading-container');
        }
        if (self._elements.overlay == null) {
            self._elements.overlay = document.getElementById('loading-overlay');
        }
    },
    show: function () {
        var self = this;
        self.init();
        self._elements.container != null ? self._elements.container.style.display = 'inline-block' : null
        self._elements.overlay != null ? self._elements.overlay.style.display = 'inline-block' : null;
    }
};

(function () {
    'use strict';
    angular
        .module('AdtechApp', ['ngMaterial', 'ngMessages', 'material.svgAssetsCache'])
        .config(function ($mdThemingProvider) {
            $mdThemingProvider.theme('default')
                .primaryPalette('orange')
                .accentPalette('deep-orange');
        })
        .controller('BaseController', function ($scope, $timeout, $mdSidenav, $mdPanel, $log) {
            var self = this, menus = typeof(AdtechApp.menu) != 'undefined' ? AdtechApp.menu : [];
            $scope.openMenu = function () {
                $timeout(function () {
                    $mdSidenav('sidenav-left').open();
                });
            };

            self.menuTemplate = '' +
                '<div class="menu-panel" md-whiteframe="4">' +
                '  <div class="menu-content">' +
                '    <div class="menu-item">' +
                '        <span>' + AdtechApp.menu.email + '</span>' +
                '    </div>' +
                '    <md-divider></md-divider>' +
                '    <div class="menu-item" ng-repeat="item in ctrl.items">' +
                '      <a class="md-button adtech-click-loading" href="{{item.link}}">' +
                '        <span>{{item.name}}</span>' +
                '      </a>' +
                '    </div>' +
                '    <md-divider></md-divider>' +
                '    <div class="menu-item">' +
                '      <button class="md-button" ng-click="ctrl.closeMenu()">' +
                '        <span>Close Menu</span>' +
                '      </button>' +
                '    </div>' +
                '  </div>' +
                '</div>';
            $scope.showToolbarMenu = function ($event, menu) {
                var template = self.menuTemplate, menu = AdtechApp.menu[menu];
                var position = $mdPanel.newPanelPosition()
                    .relativeTo($event.srcElement)
                    .addPanelPosition(
                        $mdPanel.xPosition.ALIGN_START,
                        $mdPanel.yPosition.BELOW
                    );

                var config = {
                    id: 'toolbar_' + menu.name,
                    attachTo: angular.element(document.body),
                    controller: PanelMenuController,
                    controllerAs: 'ctrl',
                    template: template,
                    position: position,
                    panelClass: 'menu-panel-container',
                    locals: {
                        items: menu.items
                    },
                    openFrom: $event,
                    focusOnOpen: false,
                    zIndex: 100,
                    propagateContainerEvents: true,
                    groupName: ['toolbar', 'menus']
                };

                $mdPanel.open(config);
            }
        })
        .directive('adtechClickLoading', function () {
            return {
                restrict: 'C',
                controller: function ($scope, $element, $attrs) {
                    $element.bind('click', function () {
                        AdtechApp.loading.show();
                    });
                }
            }
        })
        .directive('adtechForm', function () {
            return {
                restrict: 'C',
                controller: function ($scope, $element, $attrs) {
                    $scope.submitForm = function () {
                        if ($scope[$attrs.name].$valid == true) {
                            AdtechApp.loading.show();
                        }
                    }
                }
            }
        });

    function PanelMenuController(mdPanelRef) {
        this.closeMenu = function () {
            mdPanelRef && mdPanelRef.close();
        }
    };

})();