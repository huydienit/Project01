@extends('layouts.default')
@section('title'){{ $title = trans('adtech-core::titles.user.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="userCtrl">
        <md-card>
            <md-toolbar class="md-table-toolbar md-default" ng-hide="selected.length || search.show">
                <div class="md-toolbar-tools">
                    <h2 class="md-title">{{ $title }}</h2>
                    <div flex></div>
                    <md-button class="md-icon-button" ng-click="search.show = true">
                        <md-icon>filter_list</md-icon>
                        <md-tooltip>Search</md-tooltip>
                    </md-button>
                    <md-button class="md-icon-button" ng-click="getUser()">
                        <md-icon>cached</md-icon>
                        <md-tooltip>Refresh</md-tooltip>
                    </md-button>
                    <md-button class="md-icon-button" ng-click="addItem($event)">
                        <md-icon>add_box</md-icon>
                        <md-tooltip>Add new user</md-tooltip>
                    </md-button>
                </div>
            </md-toolbar>

            <md-toolbar class="md-table-toolbar md-default" ng-show="search.show && !selected.length">
                <div class="md-toolbar-tools no-form" layout="row">
                    <div flex="45">
                        <input type="text" ng-model="query.keyword" ng-model-options="search.options"
                               placeholder="key search" ng-keyup="$event.keyCode == 13 && getUser()"
                               style="margin:20px 0 26px 0; padding:2px 2px 1px; height:30px">
                    </div>
                    <div flex="15" style="margin: 0px 5px">
                        <md-select ng-change="setFilter('role', roleFilter)" ng-model="roleFilter" aria-label="Role"
                                   placeholder="Role">
                            <md-option value="">Show all</md-option>
                            <md-option ng-value="role.role_id"
                                       ng-repeat="role in roleListFilter">@{{role.name}}</md-option>
                        </md-select>
                    </div>
                    <div flex="15" style="margin: 0px 5px">
                        <md-select ng-change="setFilter('active', activeFilter)" ng-model="activeFilter"
                                   aria-label="Active" placeholder="Active">
                            <md-option value="">Show all</md-option>
                            <md-option ng-value="active.id"
                                       ng-repeat="active in activeListFilter">@{{active.name}}</md-option>
                        </md-select>
                    </div>
                    <div flex="15" style="margin: 0px 5px">
                        <md-select ng-change="setFilter('status', statusFilter)" ng-model="statusFilter"
                                   aria-label="Status" placeholder="Status">
                            <md-option value="">Show all</md-option>
                            <md-option ng-value="status.id"
                                       ng-repeat="status in statusListFilter">@{{status.name}}</md-option>
                        </md-select>
                    </div>
                    <div style="text-align: right">
                        <md-button class="md-icon-button" ng-click="getUser()" style="margin:0; padding:2px">
                            <md-icon>search</md-icon>
                        </md-button>
                        <md-button class="md-icon-button" ng-click="search.show = false; query.keyword=''; getUser()"
                                   style="margin:0; padding:2px">
                            <md-icon>close</md-icon>
                        </md-button>
                    </div>
                </div>
            </md-toolbar>

            {{--<md-toolbar class="md-table-toolbar alternate" ng-show="selected.length">--}}
            {{--<div class="md-toolbar-tools" layout-align="space-between">--}}
            {{--<div>@{{selected.length}} @{{selected.length > 1 ? 'items' : 'item'}} selected</div>--}}
            {{--<md-button class="md-icon-button" ng-click="delete($event)">--}}
            {{--<md-icon>delete</md-icon>--}}
            {{--</md-button>--}}
            {{--</div>--}}
            {{--</md-toolbar>--}}

            <md-table-container>
                {{--<table md-table md-row-select multiple ng-model="selected" md-progress="promise">--}}
                <table md-table multiple ng-model="selected" md-progress="promise">
                    <thead md-head md-order="query.order" md-on-reorder="getDesserts">
                    <tr md-row>
                        <th width="20" md-column md-order-by="id"
                            ng-click="setOrder(orderBy.id)">{{ $labelId = trans('adtech-core::common.id') }}</th>
                        <th md-column md-text md-order-by="email"
                            ng-click="setOrder(orderBy.email)">{{ $labelEmail = trans('adtech-core::common.user.email') }}</th>
                        <th md-column md-text md-order-by="username"
                            ng-click="setOrder(orderBy.username)">{{ $labelFirstName = trans('adtech-core::common.user.username') }}</th>
                        <th md-column md-text>{{ $labelLastName = trans('adtech-core::common.user.contact_name') }}</th>
                        <th md-column md-text>{{ $roleName = trans('adtech-core::common.user.role') }}</th>
                        <th md-column md-text>{{ $roleName = trans('adtech-core::common.user.active') }}</th>
                        <th md-column md-text>{{ $roleName = trans('adtech-core::common.user.status') }}</th>
                        <th width="90" align="center" md-column
                            md-numeric>{{ $labelAction = trans('adtech-core::common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    {{--<tr md-row md-select="dessert" md-select-id="name" md-auto-select ng-repeat="user in userList">--}}
                    <tr md-row md-select-id="name" md-auto-select ng-repeat="user in userEmpty">
                        <td md-cell colspan="8" style="color: #c1c1c1;"><i>@{{user.name}}</i></td>
                    </tr>
                    <tr md-row md-select-id="name" md-auto-select ng-repeat="user in userList">
                        <td md-cell><b>@{{user.id}}</b></td>
                        <td md-cell>@{{user.email}}</td>
                        <td md-cell>@{{user.username}}</td>
                        <td md-cell>@{{user.contact_name}}</td>
                        <td md-cell>@{{user.role_name}}</td>
                        <td md-cell>@{{user.activatedLBB}}</td>
                        <td md-cell>
                            <md-switch ng-change="onChangeStatus(@{{user.status}}, @{{user.id}})"
                                       ng-if="user.permission_locked == 0" aria-label="Status" md-invert
                                       ng-model="user.statusLB"></md-switch>
                        </td>
                        <td md-cell>
                            <md-menu md-position-mode="target-right target" ng-if="user.permission_locked == 0">
                                <md-button aria-label="Open demo menu" class="md-icon-button"
                                           ng-click="$mdMenu.open($event)">
                                    <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
                                </md-button>
                                <md-menu-content width="4">
                                    <md-menu-item>
                                        <md-button ng-click="showEdit($event, user.id)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('adtech-core::common.actions.edit') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">edit
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                    <md-menu-item>
                                        <md-button ng-click="showDel($event, user.id, user.email)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('adtech-core::common.actions.delete') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">delete
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                    <md-menu-item>
                                        <md-button ng-click="permissionDetails(user.url_permission_details)"
                                                   class="adtech-click-loading">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('adtech-core::common.actions.permission') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">transfer_within_a_station
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                </md-menu-content>
                            </md-menu>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </md-table-container>

            <md-table-pagination md-label="{page: 'Page', rowsPerPage: 'Rows per page', of: 'of'}"
                                 md-limit="query.limit" md-limit-options="[10, 30, 50, 100]" md-page="query.page"
                                 md-total="100" md-on-paginate="getUser" md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop

@push('scripts-view')
<script src="http://dev.afp.vn/vendor/adtech-cms-material/default/js/config.js?t={{ time() }}"></script>
<script src="http://dev.afp.vn/vendor/adtech-cms-material/default/js/services.js?t={{ time() }}"></script>
<script type="text/ng-template" id="frm-add-user">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('adtech-core::common.user.title') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">&#9932;</md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('adtech-core::common.user.email')}}</label>
                    <input ng-model="user.email" type="text" required email>
                </md-input-container>
                <md-input-container flex="50" ng-show="showpassword">
                    <label>{{trans('adtech-core::common.user.password')}}</label>
                    <input type="text" ng-model="user.password"
                           aria-label="{{trans('adtech-core::common.user.password')}}">
                </md-input-container>
                <md-input-container flex="50" ng-hide="showpassword">
                    <label>{{trans('adtech-core::common.user.password')}}</label>
                    <input type="password" ng-model="user.password"
                           aria-label="{{trans('adtech-core::common.user.password')}}">
                </md-input-container>
                <md-input-container flex="50">
                    <md-checkbox ng-model="showpassword"
                                 aria-label="{{trans('adtech-core::common.user.password_show')}}" ng-checked="false">
                        {{trans('adtech-core::common.user.password_show')}}
                    </md-checkbox>
                </md-input-container>
                <br>
                <md-input-container flex="50" ng-show="showpasswordconfirm">
                    <label>{{trans('adtech-core::common.user.password_confirm')}}</label>
                    <input type="text" ng-model="user.password_confirmation"
                           aria-label="{{trans('adtech-core::common.user.password')}}">
                </md-input-container>
                <md-input-container flex="50" ng-hide="showpasswordconfirm">
                    <label>{{trans('adtech-core::common.user.password_confirm')}}</label>
                    <input type="password" ng-model="user.password_confirmation"
                           aria-label="{{trans('adtech-core::common.user.password')}}">
                </md-input-container>
                <md-input-container flex="50">
                    <md-checkbox ng-model="showpasswordconfirm"
                                 aria-label="{{trans('adtech-core::common.user.password_show')}}" ng-checked="false">
                        {{trans('adtech-core::common.user.password_show')}}
                    </md-checkbox>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('adtech-core::common.user.username')}}</label>
                    <input ng-model="user.username" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('adtech-core::common.user.contact_name')}}</label>
                    <input ng-model="user.contact_name" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('adtech-core::common.user.role')}}</label>
                    <md-select name="type" ng-model="user.role_id" required>
                        <md-option ng-value="@{{ role.role_id }}"
                                   ng-repeat="role in roleLists">@{{ role.name }}</md-option>
                    </md-select>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert
                               ng-model="user.statusLB">{{trans('adtech-core::common.user.status')}}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert
                               ng-model="user.activatedLB">{{trans('adtech-core::common.user.active')}}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert
                               ng-model="user.permission_lockedLB">{{trans('adtech-core::common.user.lock')}}</md-switch>
                </md-input-container>
                <input ng-model="user.user_id" type="hidden">
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="addUser()" ng-disabled="myForm.$invalid"
                       class="md-primary">{{trans('adtech-core::buttons.save')}}</md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/ng-template" id="frm-edit-user">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('adtech-core::common.user.title') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">&#9932;</md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{ trans('adtech-core::common.user.email') }}</label>
                    <input ng-model="user.email" type="text" required email disabled>
                </md-input-container>
                <md-checkbox ng-model="user.showChangePass"
                             aria-label="{{ trans('adtech-core::common.user.password_change') }}">{{ trans('adtech-core::common.user.password_change') }}</md-checkbox>
                <br/><br/><br/>
                <div ng-show="user.showChangePass">
                    <md-input-container flex="50" ng-show="showpassword">
                        <label>{{ trans('adtech-core::common.user.password') }}</label>
                        <input aria-label="{{ trans('adtech-core::common.user.password') }}" type="text"
                               ng-model="user.password">
                    </md-input-container>
                    <md-input-container flex="50" ng-hide="showpassword">
                        <label>{{ trans('adtech-core::common.user.password') }}</label>
                        <input aria-label="{{ trans('adtech-core::common.user.password') }}" type="password"
                               ng-model="user.password">
                    </md-input-container>
                    <md-input-container flex="50">
                        <md-checkbox ng-model="showpassword"
                                     aria-label="{{ trans('adtech-core::common.user.password_show') }}"
                                     ng-checked="false">
                            {{ trans('adtech-core::common.user.password_show') }}
                        </md-checkbox>
                    </md-input-container>
                    <br>
                    <md-input-container flex="50" ng-show="showpasswordconfirm">
                        <label>{{ trans('adtech-core::common.user.password_confirm') }}</label>
                        <input aria-label="{{ trans('adtech-core::common.user.password') }}" type="text"
                               ng-model="user.password_confirmation">
                    </md-input-container>
                    <md-input-container flex="50" ng-hide="showpasswordconfirm">
                        <label>{{ trans('adtech-core::common.user.password_confirm') }}</label>
                        <input aria-label="{{ trans('adtech-core::common.user.password') }}" type="password"
                               ng-model="user.password_confirmation">
                    </md-input-container>
                    <md-input-container flex="50">
                        <md-checkbox ng-model="showpasswordconfirm"
                                     aria-label="{{ trans('adtech-core::common.user.password_show') }}"
                                     ng-checked="false">
                            {{ trans('adtech-core::common.user.password_show') }}
                        </md-checkbox>
                    </md-input-container>
                </div>
                <md-input-container class="md-icon-float md-block">
                    <label>{{ trans('adtech-core::common.user.username') }}</label>
                    <input ng-model="user.username" type="text" required disabled>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{ trans('adtech-core::common.user.contact_name') }}</label>
                    <input ng-model="user.contact_name" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{ trans('adtech-core::common.user.role') }}</label>
                    <md-select name="type" ng-model="user.role_id" required>
                        <md-option ng-value="@{{ role.role_id }}"
                                   ng-repeat="role in roleLists">@{{ role.name }}</md-option>
                    </md-select>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert
                               ng-model="user.statusLB">{{ trans('adtech-core::common.user.status') }}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert
                               ng-model="user.activatedLB">{{ trans('adtech-core::common.user.active') }}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%">
                    <md-switch md-invert
                               ng-model="user.permission_lockedLB">{{ trans('adtech-core::common.user.lock') }}</md-switch>
                </md-input-container>
                <input ng-model="user.user_id" type="hidden">
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="updateUser()" ng-disabled="myForm.$invalid"
                       class="md-primary">{{ trans('adtech-core::buttons.save') }}</md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var coreUsersEmpty = $.parseJSON('{!! $jsonUserEmptyString !!}');
    var coreUsers = $.parseJSON('{!! $jsonUserString !!}');
    var roleList = $.parseJSON('{!! $roleList !!}');
    var activeList = $.parseJSON('{!! $activeList !!}');
    var statusList = $.parseJSON('{!! $statusList !!}');
    var arrOrder = $.parseJSON('{!! $arrOrder !!}');
    var keyword = '{{ $keyword }}';
    var order = '{{ $order }}';
    var role = '{{ $role }}';
    var active = '{{ $active }}';
    var status = '{{ $status }}';
    var showBL = false;
    if (keyword.length > 0 || role != 0 || active != 0 || status != 0) {
        showBL = true;
    }

    angular.module("AdtechApp")
        .run(function ($rootScope) {
            $rootScope.getUser = function ($bl) {
                var query = $rootScope.query;
                var url = '{{ route('adtech.core.user.list') }}',
                    params = ['page=' + query.page, 'limit=' + query.limit, 'keyword=' + query.keyword,
                        'order=' + query.order, 'role=' + query.role, 'active=' + query.active,
                        'status=' + query.status];
                AdtechApp.loading.show();
                window.location.href = (url + '?' + params.join('&'));
            };
            $rootScope.userEmpty = coreUsersEmpty;
            $rootScope.userList = coreUsers;
            $rootScope.roleListFilter = roleList;
            $rootScope.activeListFilter = activeList;
            $rootScope.statusListFilter = statusList;
            $rootScope.roleFilter = parseInt(role);
            $rootScope.activeFilter = parseInt(active);
            $rootScope.statusFilter = parseInt(status);
            $rootScope.selected = [];
            $rootScope.search = {
                options: {
                    debounce: 500
                },
                show: showBL
            };
            $rootScope.query = {
                keyword: keyword,
                limit: {{ $limit }},
                order: order,
                role: role,
                active: active,
                status: status,
                page: {{ $pageIndex }}
            };
            $rootScope.setOrder = function (orderStr) {
                $rootScope.query.order = orderStr;
                $rootScope.getUser();
            };
            $rootScope.setFilter = function (typeFilter, filterStr) {
                if (typeFilter == 'role') {
                    $rootScope.query.role = filterStr;
                }
                if (typeFilter == 'active') {
                    $rootScope.query.active = filterStr;
                }
                if (typeFilter == 'status') {
                    $rootScope.query.status = filterStr;
                }
                $rootScope.getUser();
            };
            $rootScope.orderBy = arrOrder;
            $rootScope.permissionDetails = function (url) {
                window.location.href = (url);
            };
        });

    angular.module("AdtechApp")
        .constant("CSRF_TOKEN", '{{ csrf_token() }}')
        .run(['$http', 'CSRF_TOKEN', function ($http, CSRF_TOKEN) {
            $http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
        }]);
</script>
<script src="http://dev.afp.vn/vendor/adtech-cms-material/default/js/controllers/user.js?t={{ time() }}"></script>
@endPush