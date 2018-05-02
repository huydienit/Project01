@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.user-info.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="userCtrl">
        <md-card>
            <div class="box_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('afp.core.dashboard.index') }}">{{ trans('afp-core::labels.home') }}</a></li>
                    <li><h2 class="md-title">{{ $title }}</h2></li>
                </ul>
                <div class="action_breadcrumb" layout="row">
                    <md-button class="md-raised md-primary" ng-click="search.show = true">
                        <md-icon>search</md-icon>{{ trans('afp-core::buttons.search') }}
                    </md-button>&nbsp;
                    {{--<md-button class="md-raised md-primary" ng-click="getUser()">--}}
                        {{--<md-icon>cached</md-icon>Refresh--}}
                    {{--</md-button>--}}
                </div>
            </div>
        </md-card>
        <md-card style="padding-top: 10px">
            <div layout="row" style="padding: 10px" ng-show="search.show">
                <div flex></div>
                <div flex="60">
                    <md-grid-list md-cols="1" md-cols-sm="2" md-cols-gt-sm="4" md-row-height="4:1"
                                  md-gutter="8px" md-gutter-gt-sm="4px">

                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-input-container class="md-block" style="top:9px; width: 100%">
                                <input type="text" ng-model="query.keyword" ng-model-options="search.options"
                                       placeholder="key search" ng-keyup="$event.keyCode == 13 && getUser()">
                            </md-input-container>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('role', roleFilter)" ng-model="roleFilter" aria-label="Role"
                                       placeholder="Role" style="width: 100%">
                                <md-option value="">Show all</md-option>
                                <md-option ng-value="role.role_id"
                                           ng-repeat="role in roleListFilter">@{{role.name}}</md-option>
                            </md-select>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('active', activeFilter)" ng-model="activeFilter"
                                       aria-label="Active" placeholder="Active" style="width: 100%">
                                <md-option value="">Show all</md-option>
                                <md-option ng-value="active.id"
                                           ng-repeat="active in activeListFilter">@{{active.name}}</md-option>
                            </md-select>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('status', statusFilter)" ng-model="statusFilter"
                                       aria-label="Status" placeholder="Status" style="width: 100%">
                                <md-option value="">Show all</md-option>
                                <md-option ng-value="status.id"
                                           ng-repeat="status in statusListFilter">@{{status.name}}</md-option>
                            </md-select>
                        </md-grid-tile>
                    </md-grid-list>
                </div>
                <div flex="nogrow" style="text-align: right">
                    <md-button class="md-icon-button" ng-click="getUser()" style="margin:0; padding:2px">
                        <md-icon>search</md-icon>
                    </md-button>
                    <md-button class="md-icon-button"
                               ng-click="search.show = false; query.keyword='';query.role = 0;query.active = 0;query.status = 0; getUser()"
                               style="margin:0; padding:2px">
                        <md-icon>close</md-icon>
                    </md-button>
                </div>
            </div>
            <md-table-container>
                <table md-table>
                    <thead md-head md-order="query.order">
                    <tr md-row>
                        <th width="20" md-column>{{ $labelId = trans('afp-core::common.id') }}</th>
                        <th md-column md-text>{{ $labelEmail = trans('afp-core::common.user.email') }}</th>
                        <th md-column md-text>{{ $labelFirstName = trans('afp-core::common.user.username') }}</th>
                        <th md-column md-text>{{ trans('afp-core::common.user-info.type') }}</th>
                        <th md-column md-text>{{ trans('afp-core::common.user-info.contact_name') }}</th>
                        <th md-column md-text>{{ trans('afp-core::common.user-info.email') }}</th>
                        <th md-column md-text>{{ trans('afp-core::common.user-info.phone') }}</th>
                        <th md-column md-text>{{ trans('afp-core::common.user-info.status') }}</th>
                        <th width="60" align="center" md-column
                            md-numeric>{{ $labelAction = trans('afp-core::common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    {{--<tr md-row md-select="dessert" md-select-id="name" md-auto-select ng-repeat="user in userList">--}}
                    <tr md-row md-select-id="name" md-auto-select ng-repeat="user in userEmpty">
                        <td md-cell colspan="8" style="color: #c1c1c1;"><i>@{{user.name}}</i></td>
                    </tr>
                    <tr md-row md-select-id="name" md-auto-select ng-repeat="user in userList">
                        <td md-cell><b>@{{user.id}}</b></td>
                        <td md-cell><a ng-click="showEdit($event, user.id)">@{{user.email}}</a></td>
                        <td md-cell>@{{user.username}}</td>
                        <td md-cell>@{{user.contact_type}}</td>
                        <td md-cell>@{{user.contact_name}}</td>
                        <td md-cell>@{{user.contact_email}}</td>
                        <td md-cell>@{{user.contact_phone}}</td>
                        <td md-cell>@{{user.contact_status}}</td>
                        <td md-cell>
                            <md-menu md-position-mode="target-right target">
                                <md-button aria-label="Open demo menu" class="md-icon-button"
                                           ng-click="$mdMenu.open($event)">
                                    <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
                                </md-button>
                                <md-menu-content width="4">
                                    <md-menu-item>
                                        <md-button ng-click="showEdit($event, user.id)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('afp-core::common.actions.edit') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">edit
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

            <md-table-pagination md-label="{page: '{{ trans('afp-core::labels.page') }}', rowsPerPage: '{{ trans('afp-core::labels.rowsPerPage') }}', of: '{{ trans('afp-core::labels.of') }}'}"
                                 md-limit="query.limit" md-limit-options="[10, 30, 50, 100]" md-page="query.page"
                                 md-total="@{{ query.total }}" md-on-paginate="getUser"
                                 md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop

@push('scripts-view')
<style type="text/css">
    fieldset.standard{
        border:1px solid silver;
    }
</style>
@endPush
@push('scripts-view')
<script type="text/ng-template" id="frm-edit-user">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('afp-core::titles.user-info.edit') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">
                    <i class="material-icons">close</i>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 20px;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{ trans('afp-core::common.user.email') }}</label>
                    <input ng-model="user.email" type="text" required email disabled>
                </md-input-container>
                <md-input-container class="md-icon-float md-block" style="margin-bottom: 0px">
                    <label>{{ trans('afp-core::common.user.username') }}</label>
                    <input ng-model="user.username" type="text" required disabled>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 20%; padding: 0; margin-top:0px">
                    <md-switch md-invert ng-model="user.contact_statusLB">{{trans('afp-core::common.user-info.contact_status')}}</md-switch>
                </md-input-container>
                <fieldset class="standard">
                    <legend>Thông tin chung</legend><br>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_type') }}</label>
                        <md-select name="type" ng-model="user.contact_type" required>
                            <md-option ng-value="type.id" ng-repeat="type in typeList">@{{ type.name }}</md-option>
                        </md-select>
                    </md-input-container>
                    <br>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_manager_name') }}</label>
                        <input ng-model="user.contact_manager_name" type="text">
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_website') }}</label>
                        <input ng-model="user.contact_website" type="text">
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_sohopdong') }}</label>
                        <input ng-model="user.contact_sohopdong" type="text">
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_masothue') }}</label>
                        <input ng-model="user.contact_masothue" type="text">
                    </md-input-container>
                </fieldset><br>
                <fieldset class="standard">
                    <legend>Thông tin liên hệ</legend><br>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user.contact_name') }}</label>
                        <input ng-model="user.contact_name" type="text" required>
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_email') }}</label>
                        <input ng-model="user.contact_email" type="text" required>
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_email_cc') }}</label>
                        <input ng-model="user.contact_email_cc" type="text">
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_phone') }}</label>
                        <input ng-model="user.contact_phone" type="text" required>
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_address') }}</label>
                        <input ng-model="user.contact_address" type="text" required>
                    </md-input-container>
                </fieldset><br>
                <fieldset class="standard">
                    <legend>Thông tin thanh toán</legend><br>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_bank_name') }}</label>
                        <input ng-model="user.contact_bank_name" type="text" required>
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_branch_name') }}</label>
                        <input ng-model="user.contact_branch_name" type="text" required>
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_stk') }}</label>
                        <input ng-model="user.contact_stk" type="text" required>
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{ trans('afp-core::common.user-info.contact_cmt') }}</label>
                        <input ng-model="user.contact_cmt" type="text" required>
                    </md-input-container>
                    <md-input-container class="md-icon-float md-block">
                        <label>{{trans('afp-core::common.user-info.contact_noicap')}}</label>
                        <md-select name="type" ng-model="user.contact_noicap" required>
                            <md-option ng-value="@{{ province.id }}"
                                       ng-repeat="province in provinceList">@{{ province.name }}</md-option>
                        </md-select>
                    </md-input-container>
                </fieldset>
                <input ng-model="user.user_id" type="hidden">
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="updateUser()" ng-disabled="myForm.$invalid"
                       class="md-raised md-primary">{{ trans('afp-core::buttons.save') }}</md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var coreUsersEmpty = $.parseJSON('{!! $jsonUserEmptyString !!}');
    var coreUsers = $.parseJSON('{!! $jsonUserString !!}');
    var provinceList = $.parseJSON('{!! $provinceList !!}');
    var roleList = $.parseJSON('{!! $roleList !!}');
    var activeList = $.parseJSON('{!! $activeList !!}');
    var statusList = $.parseJSON('{!! $statusList !!}');
    var typeList = $.parseJSON('{!! $typeList !!}');
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
                var url = '{{ route('afp.core.user-info.list') }}',
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
                total: {{ $total }},
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
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/user-info.js?t=').time() }}"></script>
@endPush