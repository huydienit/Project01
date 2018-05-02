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

    function rootCtrl($scope, $mdSidenav, $mdPanel, $mdUtil, $http, $mdDialog) {
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

        this._http = $http;
        this._mdPanel = $mdPanel;
        this._mdDialog = $mdDialog;

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
                link: "/" + AdtechApp.admin_prefix + "/adtech/core/role/list"
            },{
                name: "Routes",
                link: "/" + AdtechApp.admin_prefix + "/adtech/core/route/list"
            }, {
                name: "Users",
                link: "/" + AdtechApp.admin_prefix + "/adtech/core/user/list"
            }]
        };
        // $http({
        //     method: 'POST',
        //     url: '/admin/show-alert'
        // }).then(function successCallback(response) {
        //     $scope.menu.alert = response.data;
        //     var size = Object.size($scope.menu.alert);
        //     $scope.countAlert = size;
        // }, function errorCallback() {
        //     $scope.menu.alert = [];
        //     $scope.countAlert = 0;
        // });
        this._dataMenu = $scope.menu;

        if (typeof(AdtechApp.menu) != 'undefined' && typeof(AdtechApp.menu.user) != 'undefined') {
            $scope.menu.user = AdtechApp.menu.user;
        }

        this.selected = {favoriteDessert: 'Donut'};
        this.disableParentScroll = false;
    };

    rootCtrl.prototype.showAlert = function (ev, relativeTo) {
        // var items = this._dataMenu.alert;
        // var position = this._mdPanel.newPanelPosition()
        //     .relativeTo(relativeTo)
        //     .addPanelPosition(this._mdPanel.xPosition.ALIGN_START, this._mdPanel.yPosition.BELOW);
        //
        // var config = {
        //     attachTo: angular.element(document.body),
        //     controller: panelMenuCtrl,
        //     controllerAs: 'ctrl',
        //     template: '<div class="demo-menu-example" ' +
        //     '     aria-label="Select your favorite dessert." ' +
        //     '     role="listbox">' +
        //     '   <md-list>' +
        //     '       <md-list-item' +
        //     '           aria-selected="{{dessert == ctrl.favoriteDessert}}" ' +
        //     '           ng-repeat="item in ctrl.items" ' +
        //     '           ng-href="{{ item.link }}">' +
        //     '           <div class="md-list-item-text" layout="column" style="padding: 5px 0px">' +
        //         '           <b style="margin: 0">{{ item.sitename }}</b>' +
        //         '           <h4 style="margin: 0">Username: {{ item.username }}</h4>' +
        //         '           <i>Created at: {{ item.created_at }}</i>' +
        //     '           </div>' +
        //     '       </md-list-item>' +
        //     '       <md-list-item>' +
        //     '           <div class="md-list-item-text" layout="column" style="padding: 5px 0px">' +
        //     '               <a href="/admin/afp/core/site/manage?status=3"><b style="color: rgba(0,0,0,.87)">>> Xem tất cả</b></a>' +
        //     '               <md-divider ng-if="!$last"></md-divider>' +
        //     '           </div>' +
        //     '       </md-list-item>' +
        //     '   </md-list>' +
        //     '</div>',
        //     panelClass: 'demo-menu-example',
        //     position: position,
        //     locals: {
        //         'selected': this.selected,
        //         'items': items
        //     },
        //     openFrom: ev,
        //     clickOutsideToClose: true,
        //     escapeToClose: true,
        //     focusOnOpen: false,
        //     zIndex: 2
        // };
        // this._mdPanel.open(config);
    }

    rootCtrl.prototype.showMenu = function (ev, relativeTo, items) {
        console.log(items);
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
            // templateUrl: 'setting-menu-item',
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
        if(relativeTo == '.settings-menu') {
            config.templateUrl = 'setting-menu-item';
        }

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
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};