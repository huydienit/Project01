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
        .module('AdtechApp', ["ngMaterial", "ui.router", 'ngMessages'])
        .config(function ($mdThemingProvider, $stateProvider, $urlRouterProvider, $httpProvider, $locationProvider) {
            $mdThemingProvider.theme('default')
                .primaryPalette('orange')
                .accentPalette('deep-orange');
        })
        .controller('BaseController', [
            '$scope',
            '$timeout',
            '$rootScope',
            '$state',
            'ssSideNav',
            'ssSideNavSharedService',
            function ($scope,
                      $timeout,
                      $rootScope,
                      $state,
                      ssSideNav,
                      ssSideNavSharedService) {
                var self = this, menus = typeof(AdtechApp.menu) != 'undefined' ? AdtechApp.menu : [];
                $scope.openMenu = function () {
                    $timeout(function () {
                        $mdSidenav('sidenav-left').open();
                    });
                };

                if (typeof(AdtechApp.menu) != 'undefined') {
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
                }

                /** sidebar **/
                var _perform_change_for_demo = function () {
                    ssSideNav.setVisible('link_3', true);

                    ssSideNav.setVisibleFor([{
                        id: 'toogle_1_link_2',
                        value: true
                    }, {
                        id: 'toogle_1_link_1',
                        value: false
                    }]);

                    $timeout(function () {
                        ssSideNav.setVisible('toogle_2', false);
                    }, 1000 * 3);

                    $timeout(function () {
                        ssSideNav.sections = [{
                            id: 'toogle_3',
                            name: 'Section Heading 3',
                            type: 'heading',
                            children: [{
                                name: 'Toogle 3',
                                type: 'toggle',
                                pages: [{
                                    id: 'toogle_3_link_1',
                                    name: 'item 1',
                                    state: 'common.toggle3.item1'
                                }, {
                                    id: 'toogle_3_link_2',
                                    name: 'item 2',
                                    state: 'common.toggle3.item2'
                                }]
                            }]
                        }];
                    }, 1000 * 6);

                    $timeout(function () {
                        ssSideNav.forceSelectionWithId('toogle_3_link_1');
                    }, 1000 * 10);
                };

                $scope.onClickMenu = function () {
                    $mdSidenav('left').toggle();
                };

                $scope.menu = ssSideNav;

                // Listen event SS_SIDENAV_CLICK_ITEM to close menu
                $scope.$on('SS_SIDENAV_CLICK_ITEM', function () {
                    console.log('do whatever you want after click on item');
                });

                _perform_change_for_demo();
            }])
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