@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.channel.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="channelCtrl">
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
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.channel.name') }}</span>
                        </th>
                        <th width="90" align="center" md-column
                            md-numeric>{{ $labelAction = trans('afp-core::common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    <tr md-row md-select="item.id" md-select-id="item.id" md-auto-select ng-repeat="item in itemList">
                        <td md-cell>@{{item.id}}</td>
                        <td md-cell>
                            <strong>@{{item.name}}</strong>
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
                                 md-total="@{{query.total}}" md-on-paginate="getBox"
                                 md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop

@push('scripts-view')
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
                    <label>{{ trans('afp-core::labels.name') }}</label>
                    <input ng-model="item.name" type="text" required>
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="addChannel()" ng-disabled="myForm.$invalid" class="md-primary">
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
                    <label>{{ trans('afp-core::labels.name') }}</label>
                    <input ng-model="item.name" type="text" required>
                    <input ng-model="item.id" type="hidden">
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="updateChannel()" ng-disabled="myForm.$invalid" class="md-primary">
                Save
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var coreItem = $.parseJSON('{!! $jsonchannelString !!}');
    angular.module("AdtechApp")
        .run(function ($rootScope) {
            $rootScope.getBox = function () {
                var query = $rootScope.query;
                var url = '{{ route('afp.core.channel.list') }}',
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
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/channel.js?t=').time() }}"></script>

@endPush
