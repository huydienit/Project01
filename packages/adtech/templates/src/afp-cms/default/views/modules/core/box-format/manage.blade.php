@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.box-format.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="boxFormatCtrl">
        <md-card>
            <div class="box_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('afp.core.dashboard.index') }}">{{ trans('afp-core::labels.home') }}</a></li>
                    <li><h2 class="md-title">{{ $title }}</h2></li>
                </ul>
                <div class="action_breadcrumb" layout="row">
                    <md-button class="md-raised md-primary" ng-click="addItem($event)">
                        <md-icon>add_box</md-icon>{{ trans('afp-core::buttons.create') }}
                    </md-button>
                </div>
            </div>
        </md-card>
        <md-card style="padding-top: 10px">
            <md-table-container style="margin: 20px 0px">
                <table md-table multiple>
                    <thead md-head>
                    <tr md-row>
                        <th width="20" md-column><span>{{ $labelId = trans('afp-core::common.id') }}</span></th>
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.box-format.name') }}</span>
                        </th>
                        <th width="90" align="center" md-column
                            md-numeric>{{ $labelAction = trans('afp-core::common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    <tr md-row md-select="box.id" md-select-id="box.id" md-auto-select ng-repeat="box in boxList">
                        <td md-cell>@{{box.id}}</td>
                        <td md-cell>
                            <a ng-click="showEdit($event, box.id)"><strong>@{{box.name}}</strong></a>
                        </td>
                        <td md-cell>
                            <md-menu md-position-mode="target-right target">
                                <md-button aria-label="Open demo menu" class="md-icon-button"
                                           ng-click="$mdMenu.open($event)">
                                    <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
                                </md-button>
                                <md-menu-content width="4">
                                    <md-menu-item>
                                        <md-button ng-click="showEdit($event, box.id)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('afp-core::common.actions.edit') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">edit
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                    <md-menu-item>
                                        <md-button ng-click="showDel($event, box.id)">
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

            <md-table-pagination md-label="{page: '{{ trans('afp-core::labels.page') }}', rowsPerPage: '{{ trans('afp-core::labels.rowsPerPage') }}', of: '{{ trans('afp-core::labels.of') }}'}"
                                 md-limit="query.limit" md-limit-options="[10, 30, 50, 100]" md-page="query.page"
                                 md-total="@{{ query.total }}" md-on-paginate="getBox"
                                 md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop

@push('scripts-view')
<script type="text/ng-template" id="frm-add-box">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('afp-core::titles.box-format.add') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">
                    <i class="material-icons">close</i>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{ trans('afp-core::labels.name') }}</label>
                    <input ng-model="box.name" type="text" required>
                </md-input-container>
                <md-input-container class="md-block">
                    <label>{{ trans('afp-core::labels.description') }}</label>
                    <textarea ng-model="box.description" md-maxlength="150" rows="5" md-select-on-focus></textarea>
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="addBox()" ng-disabled="myForm.$invalid" class="md-raised md-primary">
                {{ trans('afp-core::buttons.save') }}
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/ng-template" id="frm-edit-box">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('afp-core::titles.box-format.edit') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">
                    <i class="material-icons">close</i>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{ trans('afp-core::labels.name') }}</label>
                    <input ng-model="box.name" type="text" required>
                    <input ng-model="box.id" type="hidden">
                </md-input-container>
                <md-input-container class="md-block">
                    <label>{{ trans('afp-core::labels.description') }}</label>
                    <textarea ng-model="box.description" md-maxlength="150" rows="5" md-select-on-focus></textarea>
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="showDel($event, box.id)" class="md-raised md-warn">
                {{trans('afp-core::buttons.delete')}}
            </md-button>
            <md-button ng-click="updateBox()" ng-disabled="myForm.$invalid" class="md-raised md-primary">
                Save
            </md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var coreBox = $.parseJSON('{!! $jsonBoxFormatString !!}');
    angular.module("AdtechApp")
        .run(function ($rootScope) {
            $rootScope.getBox = function () {
                var query = $rootScope.query;
                var url = '{{ route('afp.core.box-format.list') }}',
                    params = ['page=' + query.page, 'limit=' + query.limit];
                AdtechApp.loading.show();
                window.location.href = (url + '?' + params.join('&'));
            };
            $rootScope.boxList = coreBox;
            $rootScope.selected = [];
            $rootScope.query = {
                filter: '',
                total: {{ $total }},
                limit: {{ $limit }},
                order: 'box.name',
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

<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/box-format.js?t=').time() }}"></script>
@endPush
