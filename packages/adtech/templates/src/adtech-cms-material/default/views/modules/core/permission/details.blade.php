@extends('layouts.default')
@section('title'){{ $title = trans('adtech-core::titles.route.manage') }}@stop
@section('content')
    <div layout-no-padding="" ng-controller="permissionCtrl">
        <md-card>
            <md-toolbar class="md-table-toolbar md-default" style="padding: 20px 0px">
                <div class="md-toolbar-tools">
                    <i class="material-icons">person</i>&nbsp;
                    <h2 class="md-title">@{{ txt.title }}</h2>
                    <md-button class="md-icon-button" ng-click="editForm($event, '{{$objectType}}', {{$objectId}})">
                        <md-icon>border_color</md-icon>
                        <md-tooltip>{{ trans('adtech-core::buttons.edit') }}</md-tooltip>
                    </md-button>
                </div>
            </md-toolbar>
        </md-card>
        <md-card>
            <md-toolbar class="md-table-toolbar md-default">
                <div class="md-toolbar-tools">
                    <div flex="50">
                        <h2 class="md-title">{{ $title }}</h2>
                    </div>
                    <div flex="50" style="text-align: right">
                        <md-input-container>
                            <md-select ng-model="filter_package" placeholder="Package"
                                       md-selected-text="filterChangeP()" style="min-width: 200px">
                                <md-option ng-value="package"
                                           ng-repeat="package in packages">@{{ package.name }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <md-select ng-model="filter_module" placeholder="Module" md-selected-text="filterChangeM()"
                                       style="min-width: 200px">
                                <md-option ng-value="module"
                                           ng-repeat="module in modules">@{{ module.name }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-button class="md-fab md-mini" aria-label="Search" ng-click="filterChange()">
                            <md-icon>search</md-icon>
                        </md-button>
                    </div>
                </div>
            </md-toolbar>

            <md-toolbar class="md-table-toolbar alternate" ng-show="selected.length">
                <div class="md-toolbar-tools" layout-align="space-between">
                    <div>@{{selected.length}} @{{selected.length > 1 ? 'items' : 'item'}} selected</div>
                    <md-button class="md-icon-button" ng-click="delete($event)">
                        <md-icon>delete</md-icon>
                    </md-button>
                </div>
            </md-toolbar>
            <md-table-container>
                <table md-table multiple ng-model="selected" md-progress="promise">
                    <thead md-head md-order="query.order" md-on-reorder="getRoles">
                    <tr md-row>
                        <th width="20" md-column><span>{{ $labelId = trans('adtech-core::common.sequence') }}</span>
                        </th>
                        <th md-column md-text md-order-by="role.name">
                            <span>{{ $labelName = trans('adtech-core::common.route.name') }}</span></th>
                        <th md-column md-text md-order-by="role.uri">
                            <span>{{ $labelURI = trans('adtech-core::common.route.uri') }}</span></th>
                        <th md-column md-text md-order-by="role.controller">
                            <span>{{ $labelURI = trans('adtech-core::common.route.controllerAction') }}</span></th>
                        <th md-column width="30" style="text-align: center;">
                            <span>{{ $labelAllow = trans('adtech-core::common.permission.allow') }}</span></th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    @foreach ($routes['routes'] as $k => $route)
                        @if (isset($route->action['as']))
                            <tr md-row md-select="" md-select-id="role.id" md-auto-select>
                                <td md-cell>{{ $k + 1 }}</td>
                                <td md-cell>
                                    @if (isset($route->action['as']))
                                        {{ $route->action['as'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td md-cell>
                                    <div>{{ $route->uri }}</div>
                                    @if ($route->wheres)
                                        @foreach ($route->wheres as $k => $v)
                                            <div>{{ $k }}: {{ $v }}</div>
                                        @endforeach
                                    @endif
                                </td>
                                <td md-cell>
                                    @if (isset($route->action['controller']))
                                        {{ $route->action['controller'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td md-cell>
                                    @if (isset($route->action['as']))
                                        <div layout="row" layout-align="center center">
                                            <div>
                                                <md-button aria-label="" class="md-icon-button" ng-click="">
                                                    <md-tooltip>{{ trans('adtech-core::labels.extra_params') }}</md-tooltip>
                                                    <md-icon class="md-default-theme" class="material-icons">settings
                                                    </md-icon>
                                                </md-button>
                                            </div>
                                            @if ($object->canAccess($route->action['as']))
                                                <div>
                                                    <md-switch
                                                            aria-label="{{ trans('adtech-core::messages.permission.allow') }}"
                                                            ng-init="data['{{ $route->action['as'] }}'] = true"
                                                            ng-checked="data['{{ $route->action['as'] }}']"
                                                            ng-true-value="1" ng-false-value="0"
                                                            ng-model="data['{{ $route->action['as'] }}']"
                                                            ng-change="onChange(data['{{ $route->action['as'] }}'], '{{ $route->action['as'] }}')"
                                                            class="md-warn"></md-switch>
                                                </div>
                                            @else
                                                <div>
                                                    <md-switch
                                                            aria-label="{{ trans('adtech-core::messages.permission.deny') }}"
                                                            ng-model="data['{{ $route->action['as'] }}']"
                                                            ng-change="onChange(data['{{ $route->action['as'] }}'], '{{ $route->action['as'] }}')"
                                                            class="md-warn"></md-switch>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </md-table-container>
        </md-card>
    </div>
@stop

@push('scripts-view')
<script src="http://devx2.laravel.vn/vendor/adtech-cms-material/default/js/config.js?t={{ time() }}"></script>
<script src="http://devx2.laravel.vn/vendor/adtech-cms-material/default/js/services.js?t={{ time() }}"></script>
<script type="text/ng-template" id="frm-edit-role">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>Manager Roles</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">&#9932;</md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>Name</label>
                    <input ng-model="role.name" type="text" required>
                    <input ng-model="role.role_id" type="hidden">
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="updateRole()" ng-disabled="myForm.$invalid" class="md-primary">
                Save
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/ng-template" id="frm-edit-user">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>Manager User</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">&#9932;</md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>Email</label>
                    <input ng-model="user.email" type="text" required email disabled>
                </md-input-container>
                <md-checkbox ng-model="user.showChangePass" aria-label="Change Password">Change Password</md-checkbox>
                <br/><br/><br/>
                <div ng-show="user.showChangePass">
                    <md-input-container class="md-icon-float md-block">
                        <label>Password</label>
                    </md-input-container>
                    <md-input-container flex="50">
                        <input ng-show="showpassword" aria-label="Password" type="text" ng-model="user.password">
                    </md-input-container>
                    <md-input-container flex="50">
                        <input ng-hide="showpassword" aria-label="Password" type="password" ng-model="user.password">
                    </md-input-container>
                    <md-input-container flex="50">
                        <md-checkbox ng-model="showpassword" aria-label="Show password" ng-checked="false">
                            'Show password
                        </md-checkbox>
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>Password Confirm</label>
                    </md-input-container>
                    <md-input-container flex="50">
                        <input ng-show="showpasswordconfirm" aria-label="Password" type="text"
                               ng-model="user.password_confirmation">
                    </md-input-container>
                    <md-input-container flex="50">
                        <input ng-hide="showpasswordconfirm" aria-label="Password" type="password"
                               ng-model="user.password_confirmation">
                    </md-input-container>
                    <md-input-container flex="50">
                        <md-checkbox ng-model="showpasswordconfirm" aria-label="Show password" ng-checked="false">
                            'Show password
                        </md-checkbox>
                    </md-input-container>
                </div>
                <md-input-container class="md-icon-float md-block">
                    <label>First name</label>
                    <input ng-model="user.first_name" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>Last name</label>
                    <input ng-model="user.last_name" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>Role</label>
                    <md-select name="type" ng-model="user.role_id" required>
                        <md-option ng-value="@{{ role.role_id }}"
                                   ng-repeat="role in roleLists">@{{ role.name }}</md-option>
                    </md-select>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert ng-model="user.status">Status</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert ng-model="user.activated">Activated</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert ng-model="user.permission_locked">Permission Lock</md-switch>
                </md-input-container>
                <input ng-model="user.user_id" type="hidden">
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="updateRole()" ng-disabled="myForm.$invalid" class="md-primary">
                Save
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var packages = $.parseJSON('{!! $arrPackage !!}');
    var modules = $.parseJSON('{!! $arrModule !!}');
    var filter_package = $.parseJSON('{!! $filter_package !!}');
    var filter_module = $.parseJSON('{!! $filter_module !!}');
    var arrcanAccess = $.parseJSON('{!! $arrCanAccess !!}');
    var roleList = $.parseJSON('{!! $roleList !!}');
    var urlshowrole = '{{ route('adtech.core.role.show') }}';
    var urlshowuser = '{{ route('adtech.core.user.show') }}';
    var urlupdaterole = '{{ route('adtech.core.role.update') }}';
    var urlupdateuser = '{{ route('adtech.core.user.update') }}';

    angular.module("AdtechApp")
        .constant("CSRF_TOKEN", '{{ csrf_token() }}')
        .run(['$http', 'CSRF_TOKEN', function ($http, CSRF_TOKEN) {
            $http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
        }]);
    angular.module("AdtechApp")
        .run(function ($rootScope, $http, $mdToast) {
            $rootScope.txt = {
                title: '{{ ucfirst($objectType).': '.$object->name }}',
            };
            $rootScope.onChange = function (cbState, routeName) {
                var allow = cbState == true ? 1 : 0;
                var check = true;
                //$rootScope.message = cbState;
                if (allow == 1) {
                    if (arrcanAccess.indexOf(routeName) > -1) {
                        check = false;
                    }
                } else {
                    var i = arrcanAccess.indexOf(routeName);
                    if (i != -1) {
                        arrcanAccess.splice(i, 1);
                    }
                }
                if (check == true) {
                    $http({
                        method: 'POST',
                        url: '{{ route("adtech.core.permission.set") }}',
                        headers: {'Content-Type': 'application/json; charset=UTF-8'},
                        data: {
                            object_type: '{{ $objectType }}',
                            object_id: '{{ $objectId }}',
                            route_name: routeName,
                            allow: allow
                        }
                    }).success(function (response) {
                        if (response.data.allow == 1) {
                            var mess = 'Cấp quyền route: ' + response.data.route_name;
                        } else {
                            var mess = 'Huỷ quyền route: ' + response.data.route_name;
                        }
                        $mdToast.show(
                            $mdToast.simple()
                                .textContent(mess)
                                .theme("success-toast")
                                .position('top right')
                                .action('⛌')
                        );
                    });
                }
            };

            $rootScope.$watch('data', function (newVal, oldVal) {

            });
        });
</script>
<script src="http://devx2.laravel.vn/vendor/adtech-cms-material/default/js/controllers/permission.js?t={{ time() }}"></script>
@endPush
