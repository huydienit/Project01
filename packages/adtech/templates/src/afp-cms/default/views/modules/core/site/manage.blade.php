@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.site.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="siteCtrl">
        <md-card>
            <div class="box_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('afp.core.dashboard.index') }}">{{ trans('afp-core::labels.home') }}</a></li>
                    <li><h2 class="md-title">{{ $title }}</h2></li>
                </ul>
                <div class="action_breadcrumb" layout="row">
                    <md-button class="md-raised md-primary" ng-click="search.show = true" style="margin: 0">
                        <md-icon>search</md-icon>{{ trans('afp-core::buttons.search') }}
                    </md-button>&nbsp;
                    {{--<md-button class="md-raised md-primary" ng-click="getSite()" style="margin: 0">--}}
                        {{--<md-icon>cached</md-icon>Refresh--}}
                    {{--</md-button>&nbsp;--}}
                    <md-button class="md-raised md-primary" ng-click="addItem($event)" style="margin: 0">
                        <md-icon>add_box</md-icon>{{ trans('afp-core::buttons.create') }}
                    </md-button>
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
                                   placeholder="{{ trans('afp-core::common.key_search') }}" ng-keyup="$event.keyCode == 13 && getSite()">
                            </md-input-container>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('category', categoryFilter)" ng-model="categoryFilter"
                                       aria-label="Danh mục" placeholder="Danh mục" style="width: 100%">
                                <md-option value="">{{ trans('afp-core::common.show_all') }}</md-option>
                                <md-option ng-value="category.category_id"
                                           ng-repeat="category in categoryListFilter">@{{category.name}}</md-option>
                            </md-select>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('tag', tagFilter)" ng-model="tagFilter" aria-label="Tag"
                                       placeholder="Tag" style="width: 100%">
                                <md-option value="">{{ trans('afp-core::common.show_all') }}</md-option>
                                <md-option ng-value="tag.id" ng-repeat="tag in tagListFilter">@{{tag.name}}</md-option>
                            </md-select>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('status', statusFilter)" ng-model="statusFilter"
                                       aria-label="Trạng thái" placeholder="Trạng thái" style="width: 100%">
                                <md-option value="">{{ trans('afp-core::common.show_all') }}</md-option>
                                <md-option ng-value="status.id"
                                           ng-repeat="status in statusListFilter">@{{status.name}}</md-option>
                            </md-select>
                        </md-grid-tile>
                    </md-grid-list>
                </div>
                <div flex="nogrow" style="text-align: right" layout="row">
                    <md-button class="md-icon-button" ng-click="getSite()" style="margin:0; padding:2px">
                        <md-icon>search</md-icon>
                    </md-button>
                    <md-button class="md-icon-button" style="margin:0; padding:2px"
                               ng-click="search.show = false; query.keyword=''; query.status=0; query.category=0; query.tag=0; getSite()"
                               style="margin:0; padding:2px">
                        <md-icon>close</md-icon>
                    </md-button>
                </div>
            </div>

            <md-table-container style="margin-top: 20px">
                <table md-table multiple>
                    <thead md-head md-order="query.order">
                    <tr md-row>
                        <th md-column md-text width="40">{{ trans('afp-core::site.table.id') }}</th>
                        <th md-column md-text>{{ trans('afp-core::site.table.sitename') }}</th>
                        <th md-column md-text>{{ trans('afp-core::site.table.user') }}</th>
                        <th md-column md-text class="txt-right">{{ trans('afp-core::site.table.slzone') }}</th>
                        <th md-column md-text>{{ trans('afp-core::site.table.traffic') }}</th>
                        <th md-column width="60" class="txt-center">{{ trans('afp-core::site.table.status') }}</th>
                        <th md-column width="60" class="txt-center">{{ $labelAction = trans('afp-core::common.action') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    <tr md-row ng-repeat="site in siteEmpty">
                        <td md-cell colspan="7" style="color: #c1c1c1;"><i>@{{site.name}}</i></td>
                    </tr>
                    <tr md-row md-auto-select ng-repeat="site in siteList">
                        <td md-cell>@{{site.site_id}}</td>
                        <td md-cell><a ng-click="showEdit(site.site_id)">@{{site.sitename}}</a></td>
                        <td md-cell>@{{site.username}}</td>
                        <td md-cell class="txt-right"><a ng-click="zoneDetails(site.zonedetailurl)">@{{site.slzone|number}}</a></td>
                        <td md-cell>Visit: <b>@{{site.visits|number}}</b> / Pageview: <b>@{{site.pageviews|number}}</b>
                        </td>
                        <td md-cell>
                            <md-switch aria-label="Status"
                                       ng-change="onChangeStatus(@{{site.site_status}}, @{{site.site_id}})" md-invert
                                       ng-model="site.statusLB"></md-switch>
                        </td>
                        <td md-cell>
                            <md-menu md-position-mode="target-right target">
                                <md-button aria-label="Open demo menu" class="md-icon-button"
                                           ng-click="$mdMenu.open($event)">
                                    <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
                                </md-button>
                                <md-menu-content width="4">
                                    <md-menu-item>
                                        <md-button ng-click="zoneDetails(site.zonedetailurl)"
                                                   class="adtech-click-loading">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('afp-core::site.table.qlzone') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">transfer_within_a_station
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                    <md-menu-item>
                                        <md-button ng-click="showEdit(site.site_id)">
                                            <div layout="row" flex>
                                                <p flex>{{ trans('afp-core::common.actions.edit') }}</p>
                                                <md-icon class="md-default-theme" class="material-icons"
                                                         style="margin: auto 3px auto 0;">edit
                                                </md-icon>
                                            </div>
                                        </md-button>
                                    </md-menu-item>
                                    <md-menu-item>
                                        <md-button ng-click="showDel($event, site.site_id)">
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
                                 md-total="@{{ query.total }}" md-on-paginate="getSite"
                                 md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop
@push('scripts-view')
<script type="text/ng-template" id="frm-add-site">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('afp-core::site.add') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">
                    <i class="material-icons">close</i>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.sitename')}}</label>
                    <input ng-model="site.sitename" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.user')}}</label>
                    <input ng-model="site.username" type="text" required>
                </md-input-container>

                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.category')}}</label>
                    <md-select name="type" ng-model="site.category" required>
                        <md-option ng-value="@{{ category.category_id }}"
                                   ng-repeat="category in categoryList">@{{ category.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.price_sale')}}</label>
                    <input ng-model="site.price_sale" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.price_buy')}}</label>
                    <input ng-model="site.price_buy" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.visits')}}</label>
                    <input ng-model="site.visits" type="text">
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.pageviews')}}</label>
                    <input ng-model="site.pageviews" type="text">
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.rank_country')}}</label>
                    <input ng-model="site.rank_country" type="text">
                </md-input-container>
                <h3>Tags:</h3>
                <div layout-wrap layout-gt-sm="row">
                    <label ng-repeat="tag in tagList" style="width: 25%">
                        <input type="checkbox" ng-model="site.tags[tag.id]"> @{{tag.name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                </div>
                <md-input-container class="md-icon-float md-block">
                    <md-switch md-invert ng-model="site.statusLB">{{trans('afp-core::site.form.status')}}</md-switch>
                </md-input-container>
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="addSite()" ng-disabled="myForm.$invalid"
                       class="md-raised md-primary">{{trans('afp-core::buttons.save')}}</md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/ng-template" id="frm-edit-site">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('afp-core::site.edit') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">
                    <i class="material-icons">close</i>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content style="padding: 2em;">
            <form name="myForm">
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.sitename')}}</label>
                    <input ng-model="site.sitename" type="text" required disabled>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.user')}}</label>
                    <input ng-model="site.username" type="text" required disabled>
                </md-input-container>

                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.category')}}</label>
                    <md-select name="type" ng-model="site.category" required>
                        <md-option ng-value="@{{ category.category_id }}"
                                   ng-repeat="category in categoryList">@{{ category.name }}</md-option>
                    </md-select>
                </md-input-container>
                <br>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.price_sale')}}</label>
                    <input ng-model="site.price_sale" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.price_buy')}}</label>
                    <input ng-model="site.price_buy" type="text" required>
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.visits')}}</label>
                    <input ng-model="site.visits" type="text">
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.pageviews')}}</label>
                    <input ng-model="site.pageviews" type="text">
                </md-input-container>
                <md-input-container class="md-icon-float md-block">
                    <label>{{trans('afp-core::site.form.rank_country')}}</label>
                    <input ng-model="site.rank_country" type="text">
                </md-input-container>
                <h3>Tags:</h3>
                <div layout-wrap layout-gt-sm="row">
                    <label ng-repeat="tag in tagList" style="width: 25%">
                        <input type="checkbox" ng-model="site.tags[tag.id]"> @{{tag.name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                </div>
                <md-input-container class="md-icon-float" style="width: 20%; padding: 0">
                    <md-switch md-invert ng-model="site.statusLB">{{trans('afp-core::site.form.status')}}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 30%; padding: 0">
                    <md-switch md-invert
                               ng-model="site.cpcstatusLB">{{trans('afp-core::site.form.cpcstatus')}}</md-switch>
                </md-input-container>
                <md-input-container class="md-icon-float" style="width: 20%; padding: 0">
                    <md-switch md-invert
                               ng-model="site.cpcreportLB">{{trans('afp-core::site.form.cpcreport')}}</md-switch>
                </md-input-container>
                <input ng-model="site.site_id" type="hidden">
            </form>
        </md-dialog-content>
        <md-dialog-actions>
            <md-button ng-click="showDel($event, site.site_id)"
                       class="md-raised md-warn">{{trans('afp-core::buttons.delete')}}</md-button>
            <md-button ng-click="updateSite()" ng-disabled="myForm.$invalid"
                       class="md-raised md-primary">{{trans('afp-core::buttons.save')}}</md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var coreSiteEmpty = $.parseJSON('{!! $jsonSiteEmptyString !!}'),
        coreSite = $.parseJSON('{!! $jsonSiteString !!}'),
        categoryList = $.parseJSON('{!! $categoryList !!}'),
        tagList = $.parseJSON('{!! $tagList !!}'),
        typeList = $.parseJSON('{!! $typeList !!}'),
        statusList = $.parseJSON('{!! $statusList !!}'),
        category = '{{ $category }}',
        keyword = '{{ $keyword }}',
        status = '{{ $status }}',
        type = '{{ $type }}',
        tag = '{{ $tag }}',
        edit = '{{ $edit }}',
        site_id = '{{ $site_id }}',
        showBL = false;
    if (keyword.length > 0 || status != 0 || type != 0 || tag != 0 || category != 0) {
        showBL = true;
    }

    angular.module("AdtechApp")
        .run(function ($rootScope) {
            $rootScope.getSite = function ($bl) {
                var query = $rootScope.query;
                var url = '{{ route('afp.core.site.manage') }}',
                    params = ['page=' + query.page, 'limit=' + query.limit,
                        'status=' + query.status, 'keyword=' + query.keyword,
                        'category=' + query.category, 'tag=' + query.tag,
                        'type=' + query.type];
                AdtechApp.loading.show();
                window.location.href = (url + '?' + params.join('&'));
            };
            $rootScope.siteEmpty = coreSiteEmpty;
            $rootScope.siteList = coreSite;
            $rootScope.categoryListFilter = categoryList;
            $rootScope.categoryFilter = parseInt(category);
            $rootScope.tagListFilter = tagList;
            $rootScope.tagFilter = parseInt(tag);
            $rootScope.typeListFilter = typeList;
            $rootScope.statusListFilter = statusList;
            $rootScope.typeFilter = parseInt(type);
            $rootScope.statusFilter = parseInt(status);
            $rootScope.search = {
                options: {
                    debounce: 500
                },
                show: showBL
            };
            $rootScope.query = {
                keyword: keyword,
                filter: '',
                status: status,
                category: category,
                tag: tag,
                type: type,
                total: {{ $total }},
                limit: {{ $limit }},
                page: {{ $pageIndex }}
            };
            $rootScope.setFilter = function (typeFilter, filterStr) {
                if (typeFilter == 'type') {
                    $rootScope.query.type = filterStr;
                }
                if (typeFilter == 'status') {
                    $rootScope.query.status = filterStr;
                }
                if (typeFilter == 'category') {
                    $rootScope.query.category = filterStr;
                }
                if (typeFilter == 'tag') {
                    $rootScope.query.tag = filterStr;
                }
                $rootScope.getSite();
            };
            $rootScope.zoneDetails = function (url) {
                window.location.href = (url);
            };
        });
    angular.module("AdtechApp")
        .constant("CSRF_TOKEN", '{{ csrf_token() }}')
        .run(['$http', 'CSRF_TOKEN', function ($http, CSRF_TOKEN) {
            $http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
        }]);
</script>
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/site.js?t=').time() }}"></script>
@endPush