AdtechApp = AdtechApp || [];
AdtechApp.loading = {
    _elements: {
        container: null,
        overlay: null
    },
    init: function() {
        var self = this;
        if (self._elements.container == null) {
            self._elements.container = document.getElementById('loading-container');
        }
        if (self._elements.overlay == null) {
            self._elements.overlay = document.getElementById('loading-overlay');
        }
    },
    show: function() {
        var self = this;
        self.init();
        self._elements.container != null ? self._elements.container.style.display = 'inline-block' : null
        self._elements.overlay != null ? self._elements.overlay.style.display = 'inline-block' : null;
    }
};

(function() {
    'use strict';

    angular.module('AdtechApp', ["md.data.table", "ngMaterial", "ngMessages"])
        .config(function ($mdThemingProvider) {
            $mdThemingProvider.theme('default')
                .primaryPalette('orange')
                .accentPalette('deep-orange');
        })
        .controller('RootCtrl', rootCtrl)
        //.controller('PanelDialogCtrl', panelDialogCtrl)
        .directive("adtechScrollClass", function() {
            return {
                restrict: "A",
                link: function(e, t, a) {
                    function n() {
                        var e = 0 !== o[0].scrollTop;
                        e !== l && t.toggleClass(a.adtechScrollClass, e), l = e
                    }
                    var o = t.parent(),
                        l = !1;
                    n(), o.on("scroll", n)
                }
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

    function rootCtrl($scope, $mdSidenav, $mdPanel, $mdUtil) {
        var main = document.querySelector("[role='main']"),
            scroll = main.querySelector("md-content[md-scroll-y]");
        $scope.scrollTop = function() {
            $mdUtil.animateScrollTo(scroll, 0, 200);
        };
        $scope.showMobileMainHeader = true;
        $scope.openSideNavPanel = function () {
            $mdSidenav('left').open();
        };
        $scope.closeSideNavPanel = function () {
            $mdSidenav('left').close();
        };

        this._mdPanel = $mdPanel;

        $scope.loading = AdtechApp.loading;

        $scope.menu = {
            user: [{
                name: "Account",
                link: "/" + AdtechApp.admin_prefix + "/dashboard"
            }, {
                name: "Logout",
                link: "/logout"
            }],
            settings: [{
                name: "Roles",
                link: "/" + AdtechApp.admin_prefix + "/afp/core/role/list"
            },{
                name: "Routes",
                link: "/" + AdtechApp.admin_prefix + "/afp/core/route/list"
            }, {
                name: "Users",
                link: "/" + AdtechApp.admin_prefix + "/afp/core/user/list"
            }]
        };

        if (typeof(AdtechApp.menu) != 'undefined' && typeof(AdtechApp.menu.user) != 'undefined') {
            $scope.menu.user = AdtechApp.menu.user;
        }

        this.selected = {favoriteDessert: 'Donut'};
        this.disableParentScroll = false;

        $scope.nutritionList = [
            {
                id: 601,
                name: 'Frozen joghurt',
                calories: 159,
                fat: 6.0,
                carbs: 24,
                protein: 4.0,
                sodium: 87,
                calcium: '14%',
                iron: '1%'
            },
            {
                id: 602,
                name: 'Ice cream sandwitch',
                calories: 237,
                fat: 9.0,
                carbs: 37,
                protein: 4.3,
                sodium: 129,
                calcium: '84%',
                iron: '1%'
            },
            {
                id: 603,
                name: 'Eclair',
                calories: 262,
                fat: 16.0,
                carbs: 24,
                protein: 6.0,
                sodium: 337,
                calcium: '6%',
                iron: '7%'
            },
            {
                id: 604,
                name: 'Cupkake',
                calories: 305,
                fat: 3.7,
                carbs: 67,
                protein: 4.3,
                sodium: 413,
                calcium: '3%',
                iron: '8%'
            },
            {
                id: 605,
                name: 'Gingerbread',
                calories: 356,
                fat: 16.0,
                carbs: 49,
                protein: 2.9,
                sodium: 327,
                calcium: '7%',
                iron: '16%'
            },
            {
                id: 606,
                name: 'Jelly bean',
                calories: 375,
                fat: 0.0,
                carbs: 94,
                protein: 0.0,
                sodium: 50,
                calcium: '0%',
                iron: '0%'
            },
            {
                id: 607,
                name: 'Lollipop',
                calories: 392,
                fat: 0.2,
                carbs: 98,
                protein: 0,
                sodium: 38,
                calcium: '0%',
                iron: '2%'
            },
            {
                id: 608,
                name: 'Honeycomb',
                calories: 408,
                fat: 3.2,
                carbs: 87,
                protein: 6.5,
                sodium: 562,
                calcium: '0%',
                iron: '45%'
            },
            {
                id: 609,
                name: 'Donut',
                calories: 452,
                fat: 25.0,
                carbs: 51,
                protein: 4.9,
                sodium: 326,
                calcium: '2%',
                iron: '22%'
            },
            {
                id: 610,
                name: 'KitKat',
                calories: 518,
                fat: 26.0,
                carbs: 65,
                protein: 7,
                sodium: 54,
                calcium: '12%',
                iron: '6%'
            }
        ];
    };

    rootCtrl.prototype.showMenu = function (ev, relativeTo, items) {
        this.items = items;
        var position = this._mdPanel.newPanelPosition()
            .relativeTo(relativeTo)
            .addPanelPosition(this._mdPanel.xPosition.ALIGN_START, this._mdPanel.yPosition.BELOW);

        var config = {
            attachTo: angular.element(document.body),
            controller: panelMenuCtrl,
            controllerAs: 'ctrl',
            template: '<div class="demo-menu-example" ' +
            '     aria-label="Select your favorite dessert." ' +
            '     role="listbox">' +
            '   <md-list>' +
            '       <md-list-item' +
            '           aria-selected="{{dessert == ctrl.favoriteDessert}}" ' +
            '           ng-repeat="item in ctrl.items" ' +
            '           ng-href="{{ item.link }}">' +
            '           <h4>{{ item.name }}</h4>' +
            '           <md-divider ng-if="!$last"></md-divider>' +
            '       </md-list-item>' +
            '   </md-list>' +
            '</div>',
            panelClass: 'demo-menu-example',
            position: position,
            locals: {
                'selected': this.selected,
                'items': items
            },
            openFrom: ev,
            clickOutsideToClose: true,
            escapeToClose: true,
            focusOnOpen: false,
            zIndex: 2
        };

        this._mdPanel.open(config);
    };


    function panelMenuCtrl(mdPanelRef, $timeout) {
        this._mdPanelRef = mdPanelRef;
        this.favoriteDessert = this.selected.favoriteDessert;
        $timeout(function () {
            var selected = document.querySelector('.demo-menu-item.selected');
            if (selected) {
                angular.element(selected).focus();
            } else {
                angular.element(document.querySelectorAll('.demo-menu-item')[0]).focus();
            }
        });
    }


    panelMenuCtrl.prototype.selectDessert = function (dessert) {
        this.selected.favoriteDessert = dessert;
        this._mdPanelRef && this._mdPanelRef.close().then(function () {
            angular.element(document.querySelector('.demo-menu-open-button')).focus();
        });
    };


    panelMenuCtrl.prototype.onKeydown = function ($event, dessert) {
        var handled, els, index, prevIndex, nextIndex;
        switch ($event.which) {
            case 38: // Up Arrow.
                els = document.querySelectorAll('.demo-menu-item');
                index = indexOf(els, document.activeElement);
                prevIndex = (index + els.length - 1) % els.length;
                els[prevIndex].focus();
                handled = true;
                break;

            case 40: // Down Arrow.
                els = document.querySelectorAll('.demo-menu-item');
                index = indexOf(els, document.activeElement);
                nextIndex = (index + 1) % els.length;
                els[nextIndex].focus();
                handled = true;
                break;

            case 13: // Enter.
            case 32: // Space.
                this.selectDessert(dessert);
                handled = true;
                break;

            case 9: // Tab.
                this._mdPanelRef && this._mdPanelRef.close();
        }

        if (handled) {
            $event.preventDefault();
            $event.stopImmediatePropagation();
        }

        function indexOf(nodeList, element) {
            for (var item, i = 0; item = nodeList[i]; i++) {
                if (item === element) {
                    return i;
                }
            }
            return -1;
        }
    };
})();