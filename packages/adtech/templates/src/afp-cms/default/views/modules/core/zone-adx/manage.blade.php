@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.zone-adx.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="zoneAdxCtrl">
        <md-card>
            <md-toolbar class="md-table-toolbar md-default" ng-hide="selected.length || filter.show">
                <div class="md-toolbar-tools">
                    <h2 class="md-title">{{ $title }}</h2>
                    <div flex></div>
                    <md-button class="md-icon-button" ng-click="addItem($event)">
                        <md-icon>add_box</md-icon>
                        <md-tooltip>{{ trans('afp-core::buttons.add_new') }}</md-tooltip>
                    </md-button>
                </div>
            </md-toolbar>
            <md-table-container>
                <table md-table multiple>
                    <thead md-head>
                    <tr md-row>
                        <th width="20" md-column><span>{{ $labelId = trans('afp-core::common.id') }}</span></th>
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.zone-adx.name') }}</span>
                        </th>
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.zone-adx.status') }}</span>
                        </th>
                        <th width="90" align="center" md-column
                            md-numeric>{{ $labelAction = trans('afp-core::common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    <tr md-row md-select="item.id" md-select-id="item.id" md-auto-select ng-repeat="item in itemList">
                        <td md-cell>@{{item.id}}</td>
                        <td md-cell><strong>@{{item.name}}</strong></td>
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
                                        <md-button ng-click="showDel($event, item.id, item.name)">
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

            <md-table-pagination md-label="{page: 'Page', rowsPerPage: 'Rows per page', of: 'of'}"
                                 md-limit="query.limit" md-limit-options="[10, 30, 50, 100]" md-page="query.page"
                                 md-total="@{{ query.total }}" md-on-paginate="getBox"
                                 md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop

@push('scripts-view')
<script src="{{ url('/vendor/afp-cms/default/js/config.js?t=').time() }}"></script>
<script src="{{ url('/vendor/afp-cms/default/js/services.js?t=').time() }}"></script>
<script type="text/ng-template" id="frm-add-item">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ $title }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">&#9932;</md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::common.zone-adx.box-format')}}</label>
                    <md-select ng-model="item.box_format_id" required>
                        <md-option ng-value="@{{ item.id }}"
                                   ng-repeat="item in boxFormatList">@{{ item.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::common.zone-adx.zone-template')}}</label>
                    <md-select ng-model="item.zone_template_id">
                        <md-option ng-value="@{{ item.id }}"
                                   ng-repeat="item in zoneTemplateList">@{{ item.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-block">
                    <label>{{trans('afp-core::common.zone-adx.notes')}}</label>
                    <textarea ng-model="item.notes" md-maxlength="150" rows="5" md-select-on-focus></textarea>
                </md-input-container>
                <md-input-container class="md-icon-float  md-block">
                    <md-switch md-invert
                               ng-model="item.bannerDefaultLB">{{ trans('afp-core::common.zone-adx.banner_default') }}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float  md-block">
                    <md-switch md-invert
                               ng-model="item.hiddenLabelLB">{{ trans('afp-core::common.zone-adx.hiddenLabel') }}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float  md-block">
                    <md-switch md-invert
                               ng-model="item.statusLB">{{ trans('afp-core::common.zone-adx.status') }}</md-switch>
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="addZoneAdx()" ng-disabled="myForm.$invalid" class="md-primary">
                {{ trans('afp-core::buttons.save') }}
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/ng-template" id="frm-edit-item">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ $title }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">&#9932;</md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::common.zone-adx.box-format')}}</label>
                    <md-select ng-model="item.box_format_id" required>
                        <md-option ng-value="@{{ item.id }}"
                                   ng-repeat="item in boxFormatList">@{{ item.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::common.zone-adx.zone-template')}}</label>
                    <md-select ng-model="item.zone_template_id">
                        <md-option ng-value="@{{ item.id }}"
                                   ng-repeat="item in zoneTemplateList">@{{ item.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-block">
                    <label>{{trans('afp-core::common.zone-adx.notes')}}</label>
                    <textarea ng-model="item.notes" md-maxlength="150" rows="5" md-select-on-focus></textarea>
                </md-input-container>
                <md-input-container class="md-icon-float  md-block">
                    <md-switch md-invert
                               ng-model="item.bannerDefaultLB">{{ trans('afp-core::common.zone-adx.banner_default') }}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float  md-block">
                    <md-switch md-invert
                               ng-model="item.hiddenLabelLB">{{ trans('afp-core::common.zone-adx.hiddenLabel') }}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float  md-block">
                    <md-switch md-invert
                               ng-model="item.statusLB">{{ trans('afp-core::common.zone-adx.status') }}</md-switch>
                </md-input-container>
                <input ng-model="item.zoneadx_id" type="hidden">
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="updateZoneAdx()" ng-disabled="myForm.$invalid" class="md-primary">
                Save
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var site_id = '{{ $site_id }}';
    var coreItem = $.parseJSON('{!! $jsonzoneAdxString !!}');
    var boxFormatList = $.parseJSON('{!! $boxFormatList !!}');
    var zoneTemplateList = $.parseJSON('{!! $zoneTemplateList !!}');
    angular.module("AdtechApp")
        .run(function ($rootScope) {
            $rootScope.getBox = function () {
                var query = $rootScope.query;
                var url = '{{ route('afp.core.zone-adx.manage', ['site_id' => $site_id]) }}',
                    params = ['page=' + query.page, 'limit=' + query.limit];
                AdtechApp.loading.show();
                window.location.href = (url + '?' + params.join('&'));
            };
            $rootScope.itemList = coreItem;
            $rootScope.selected = [];
            $rootScope.query = {
                filter: '',
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
<script src="http://dev.afp.vn/vendor/afp-cms/default/js/controllers/zone-adx.js?t={{ time() }}"></script>
@endPush
