@extends('layouts.default')
@section('title'){{ $title = trans('adtech-core::titles.role.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="roleCtrl">
        <md-card>
            <md-toolbar class="md-table-toolbar md-default" ng-hide="selected.length || filter.show">
                <div class="md-toolbar-tools">
                    <h2 class="md-title">{{ $title }}</h2>
                    <div flex></div>
                    <md-button class="md-icon-button" ng-click="addItem($event)">
                        <md-icon>add_box</md-icon>
                        <md-tooltip>{{ trans('adtech-core::buttons.add_new') }}</md-tooltip>
                    </md-button>
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
                <table md-table multiple ng-model="selected" md-progress="promise">
                    <thead md-head md-order="query.order" md-on-reorder="getRoles">
                    <tr md-row>
                        <th width="20" md-column md-order-by="role.id">
                            <span>{{ $labelId = trans('adtech-core::common.id') }}</span></th>
                        <th md-column md-text md-order-by="role.name">
                            <span>{{ $labelName = trans('adtech-core::common.role.name') }}</span></th>
                        <th width="90" align="center" md-column
                            md-numeric>{{ $labelAction = trans('adtech-core::common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    <tr md-row md-select="role.id" md-select-id="role.id" md-auto-select ng-repeat="role in roleList">
                        <td md-cell>@{{role.id}}</td>
                        <td md-cell>
                            <a href="http://ninhgio.com" class="md-icon-button"><strong>@{{role.name}}</strong></a>
                        </td>
                        <td md-cell>
                            <md-menu md-position-mode="target-right target" ng-if="role.permission_locked == 0">
                                <md-button aria-label="Open demo menu" class="md-icon-button"
                                           ng-click="$mdMenu.open($event)">
                                    <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
                                </md-button>
                                <md-menu-content width="4">
                                    <md-menu-item>
                                        <md-button ng-click="showEdit($event, role.id)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('adtech-core::common.actions.edit') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">edit
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                    <md-menu-item>
                                        <md-button ng-click="showDel($event, role.id, role.name)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('adtech-core::common.actions.delete') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">delete
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                    <md-menu-item>
                                        <md-button ng-click="permissionDetails(role.url_permission_details)"
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
                                 md-total="100" md-on-paginate="getRoles" md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop

@push('scripts-view')
<script src="http://devx2.laravel.vn/vendor/adtech-cms-material/default/js/config.js?t={{ time() }}"></script>
<script src="http://devx2.laravel.vn/vendor/adtech-cms-material/default/js/services.js?t={{ time() }}"></script>
<script type="text/ng-template" id="frm-add-role">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ $title }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">&#9932;</md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <md-input-container class="md-icon-float md-block">
                <label>{{ trans('adtech-core::labels.name') }}</label>
                <input ng-model="role.name" type="text" required>
            </md-input-container>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="addRole()" ng-disabled="myForm.$invalid" class="md-primary">
                {{ trans('adtech-core::buttons.save') }}
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
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
            <md-input-container class="md-icon-float md-block">
                <label>Name</label>
                <input ng-model="role.name" type="text" required>
                <input ng-model="role.role_id" type="hidden">
            </md-input-container>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="updateRole()" ng-disabled="myForm.$invalid" class="md-primary">
                Save
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var coreRoles = $.parseJSON('{!! $jsonRoleString !!}');
    angular.module("AdtechApp")
        .run(function ($rootScope) {
            $rootScope.getRoles = function () {
                var query = $rootScope.query;
                var url = '{{ route('adtech.core.role.list') }}',
                    params = ['page=' + query.page, 'limit=' + query.limit];
                AdtechApp.loading.show();
                window.location.href = (url + '?' + params.join('&'));
            };
            $rootScope.roleList = coreRoles;
            $rootScope.selected = [];
            $rootScope.query = {
                filter: '',
                limit: {{ $limit }},
                order: 'role.name',
                page: {{ $pageIndex }}
            };
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
<script src="http://devx2.laravel.vn/vendor/adtech-cms-material/default/js/controllers/role.js?t={{ time() }}"></script>
@endPush
