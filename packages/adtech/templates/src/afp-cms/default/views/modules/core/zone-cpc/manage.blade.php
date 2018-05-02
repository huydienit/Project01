@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.zone-cpc.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="zoneCpcCtrl">
        <md-card>
            <div class="box_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('afp.core.dashboard.index') }}">{{ trans('afp-core::labels.home') }}</a></li>
                    <li><a href="{{ route('afp.core.site.manage') }}">{{ trans('afp-core::labels.site') }}</a></li>
                    <li><h2 class="md-title">{{ $title }}</h2></li>
                </ul>
                <div class="action_breadcrumb" layout="row">
                    <md-button class="md-raised md-primary" ng-click="addItem($event)">
                        <md-icon>add_box</md-icon>
                        {{ trans('afp-core::buttons.create') }}
                    </md-button>
                </div>
            </div>
        </md-card>
        <md-card style="padding-top: 10px">
            <div layout="row">
                <div flex></div>
                <div flex="nogrow">
                    <md-input-container>
                        <label>Sitename</label>
                        <input type="text" ng-model="query.sitename" ng-keyup="$event.keyCode == 13 && getZone()"
                               placeholder="{{ trans('afp-core::common.key_search') }}">
                    </md-input-container>
                    <md-input-container>
                        <label>Username</label>
                        <input type="text" ng-model="query.username" ng-keyup="$event.keyCode == 13 && getZoneByUser()"
                               placeholder="{{ trans('afp-core::common.key_search') }}">
                    </md-input-container>
                </div>
            </div>
            <md-table-container>
                <table md-table multiple>
                    <thead md-head>
                    <tr md-row>
                        <th width="40" md-column><span>{{ $labelId = trans('afp-core::common.id') }}</span></th>
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.zone-cpc.name') }}</span>
                        </th>
                        <th width="60" class="txt-center" md-column>
                            <span>{{ $labelName = trans('afp-core::common.zone-cpc.status') }}</span></th>
                        <th width="60" class="txt-center"
                            md-column>{{ $labelAction = trans('afp-core::common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    <tr md-row md-select="item.id" md-select-id="item.id" md-auto-select ng-repeat="item in itemList">
                        <td md-cell md-text>@{{item.id}}</td>
                        <td md-cell><a ng-click="showEdit($event, item.id)"><strong>@{{item.name}}</strong></a></td>
                        <td md-cell>
                            <md-switch ng-change="onChangeStatus(@{{item.status}}, @{{item.id}})" aria-label="Status"
                                       md-invert ng-model="item.statusLB"></md-switch>
                        </td>
                        <td md-cell>
                            <md-menu md-position-mode="target-right target">
                                <md-button aria-label="Open demo menu" class="md-icon-button"
                                           ng-click="$mdMenu.open($event)">
                                    <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
                                </md-button>
                                <md-menu-content width="4">
                                    <md-menu-item>
                                        <md-button ng-click="showEdit($event, item.id)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('afp-core::common.actions.edit') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">edit
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                    <md-menu-item>
                                        <md-button ng-click="showDel($event, item.id)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('afp-core::common.actions.delete') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">delete
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

            <md-table-pagination
                    md-label="{page: '{{ trans('afp-core::labels.page') }}', rowsPerPage: '{{ trans('afp-core::labels.rowsPerPage') }}', of: '{{ trans('afp-core::labels.of') }}'}"
                    md-limit="query.limit" md-limit-options="[10, 30, 50, 100]" md-page="query.page"
                    md-total="@{{ query.total }}" md-on-paginate="getBox"
                    md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop

@push('scripts-view')
<script type="text/ng-template" id="frm-add-item">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('afp-core::titles.zone-cpc.add') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">
                    <i class="material-icons">close</i>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::common.zone-cpc.box-format')}}</label>
                    <md-select ng-model="item.box_format_id" required>
                        <md-option ng-value="@{{ item.id }}"
                                   ng-repeat="item in boxFormatList">@{{ item.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::common.zone-cpc.zone-template')}}</label>
                    <md-select ng-model="item.zone_template_id">
                        <md-option ng-value="@{{ item.id }}"
                                   ng-repeat="item in zoneTemplateList">@{{ item.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-block">
                    <label>{{trans('afp-core::common.zone-cpc.notes')}}</label>
                    <textarea ng-model="item.notes" md-maxlength="150" rows="5" md-select-on-focus></textarea>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 20%; padding: 0">
                    <md-switch md-invert
                               ng-model="item.hiddenLabelLB">{{ trans('afp-core::common.zone-cpc.hiddenLabel') }}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 20%; padding: 0">
                    <md-switch md-invert
                               ng-model="item.statusLB">{{ trans('afp-core::common.zone-cpc.status') }}</md-switch>
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="addZoneCpc()" ng-disabled="myForm.$invalid" class="md-raised md-primary">
                {{ trans('afp-core::buttons.save') }}
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/ng-template" id="frm-edit-item">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('afp-core::titles.zone-cpc.edit') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">
                    <i class="material-icons">close</i>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::common.zone-cpc.box-format')}}</label>
                    <md-select ng-model="item.box_format_id" required>
                        <md-option ng-value="@{{ item.id }}"
                                   ng-repeat="item in boxFormatList">@{{ item.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::common.zone-cpc.zone-template')}}</label>
                    <md-select ng-model="item.zone_template_id">
                        <md-option ng-value="@{{ item.id }}"
                                   ng-repeat="item in zoneTemplateList">@{{ item.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-block">
                    <label>{{trans('afp-core::common.zone-cpc.notes')}}</label>
                    <textarea ng-model="item.notes" md-maxlength="150" rows="5" md-select-on-focus></textarea>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 20%; padding: 0">
                    <md-switch md-invert
                               ng-model="item.hiddenLabelLB">{{ trans('afp-core::common.zone-cpc.hiddenLabel') }}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 20%; padding: 0">
                    <md-switch md-invert
                               ng-model="item.statusLB">{{ trans('afp-core::common.zone-cpc.status') }}</md-switch>
                </md-input-container>
                <input ng-model="item.zonecpc_id" type="hidden">
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="showDel($event, item.id)"
                       class="md-raised md-warn">{{trans('afp-core::buttons.delete')}}</md-button>
            <md-button ng-click="updateZoneCpc()" ng-disabled="myForm.$invalid" class="md-raised md-primary">
                {{ trans('afp-core::buttons.save') }}
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var site_id = '{{ $site_id }}';
    var sitename = '{{ $sitename }}';
    var username = '{{ $username }}';
    var coreItem = $.parseJSON('{!! $jsonzoneCpcString !!}');
    var boxFormatList = $.parseJSON('{!! $boxFormatList !!}');
    var zoneTemplateList = $.parseJSON('{!! $zoneTemplateList !!}');
    angular.module("AdtechApp")
        .run(function ($rootScope, $http, $mdDialog, $mdToast) {
            $rootScope.getBox = function () {
                var query = $rootScope.query;
                var url = '{{ route('afp.core.zone-cpc.manage', ['site_id' => $site_id]) }}',
                    params = ['page=' + query.page, 'limit=' + query.limit];
                AdtechApp.loading.show();
                window.location.href = (url + '?' + params.join('&'));
            };
            $rootScope.getZone = function () {
                var query = $rootScope.query;
                $http({
                    method: 'GET',
                    url: '{{ route('afp.core.site.get') }}',
                    params: {sitename: query.sitename}
                }).then(function successCallback(response) {
                    console.log(response);
                    if (response.data != '') {
//                        var site_id = response.data.site_id;
//                        var url = '/admin/afp/core/zone-cpc/manage/' + site_id,
//                            params = ['page=' + query.page, 'limit=' + query.limit];
//                        AdtechApp.loading.show();
//                        window.location.href = (url + '?' + params.join('&'));
                    }
                    else {
                        $mdToast.show(
                            $mdToast.simple()
                                .textContent('Không tìm thấy kết quả!')
                                .theme("error-toast")
                                .position('top right')
                                .action('⛌')
                        );
                    }
                }, function errorCallback($mdDialog) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                    var alert = $mdDialog.alert({
                        title: 'Error',
                        textContent: 'Have an error!',
                        ok: 'Close'
                    });
                    $mdDialog
                        .show(alert)
                        .finally(function () {
                            alert = undefined;
                        });
                });
            };
            $rootScope.getZoneByUser = function () {
                var query = $rootScope.query;
                $http({
                    method: 'GET',
                    url: '{{ route('afp.core.site.get-username') }}',
                    params: {username: query.username}
                }).then(function successCallback(response) {
                    console.log(response);
                    if (response.data != '') {
                        var site_id = response.data.site_id;
                        var url = '/admin/afp/core/zone-cpc/manage/' + site_id,
                            params = ['page=' + query.page, 'limit=' + query.limit];
                        AdtechApp.loading.show();
                        window.location.href = (url + '?' + params.join('&'));
                    }
                    else {
                        $mdToast.show(
                            $mdToast.simple()
                                .textContent('Không tìm thấy kết quả!')
                                .theme("error-toast")
                                .position('top right')
                                .action('⛌')
                        );
                    }
                }, function errorCallback($mdDialog) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                    var alert = $mdDialog.alert({
                        title: 'Error',
                        textContent: 'Have an error!',
                        ok: 'Close'
                    });
                    $mdDialog
                        .show(alert)
                        .finally(function () {
                            alert = undefined;
                        });
                });
            };

            $rootScope.itemList = coreItem;
            $rootScope.selected = [];
            $rootScope.query = {
                filter: '',
                sitename: sitename,
                username: username,
                total: {{ $total }},
                limit: {{ $limit }},
                order: 'item.name',
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
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/zone-cpc.js?t=').time() }}"></script>
@endPush
