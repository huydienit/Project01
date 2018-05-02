@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.report.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="reportCtrl">
        <md-fab-speed-dial ng-hide="false" md-direction="left" md-open="export.isOpen"
                           style="position: fixed; bottom: 25px; right: 82; height: 60px; padding-right:70px"
                           class="md-scale" ng-class="{ 'md-hover-full': export.hover }"
                           ng-mouseenter="export.isOpen=true" ng-mouseleave="export.isOpen=false">
            <md-fab-trigger>
                <md-button class="md-fab md-raised md-warn" style="position: fixed; bottom:20px; right: 82px">
                    <i class="material-icons">&#xE2C4;</i></md-button>
                </md-button>
            </md-fab-trigger>

            <md-fab-actions>
                <md-button aria-label="Export report all site" class="md-fab md-raised" ng-click="exportSite()">
                    Site
                </md-button>
                <md-button aria-label="Export report all zone by site" class="md-fab md-raised" ng-click="exportZone()">
                    Zone
                </md-button>
            </md-fab-actions>
        </md-fab-speed-dial>
        <md-card>
            <div class="box_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('afp.core.dashboard.index') }}">{{ trans('afp-core::labels.home') }}</a></li>
                    <li><h2 class="md-title">{{ $title }}</h2></li>
                </ul>
                <div class="action_breadcrumb" layout="row" style="top: 0">
                    {{--<div id="reportrange" style="background: #fff; cursor: pointer; padding: 0px 10px; border: 1px solid #ccc; height:29px; line-height: 29px">--}}
                        {{--<i class="glyphicon glyphicon-calendar fa fa-calendar" style="font-size: 16px"></i>&nbsp;--}}
                        {{--<span style="font-size: 14px"></span> <b class="caret"></b>--}}
                    {{--</div>--}}
                    <div flex>
                        <md-datepicker ng-model="query.begin" ng-change="getSiteDate()" md-placeholder="Enter date begin"></md-datepicker>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <md-datepicker ng-model="query.end" ng-change="getSiteDate()" md-placeholder="Enter date end"></md-datepicker>
                        <md-button class="md-icon-button no-bg" aria-label="Search" style="min-width: 30px"
                                   ng-click="getSiteDate()">
                            <md-icon style="font-size: 24px">search</md-icon>
                        </md-button>
                    </div>
                </div>
            </div>
        </md-card>
        <md-card style="padding-top: 10px">
            <div layout="row" style="padding: 10px" ng-show="search.show">
                <div flex></div>
                <div flex="90">
                    <md-grid-list md-cols="1" md-cols-sm="2" md-cols-gt-sm="4" md-row-height="5:1"
                                  md-gutter="8px" md-gutter-gt-sm="4px">

                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-input-container class="md-block" style="top:9px; width: 100%">
                                <input type="text" ng-model="query.keyword" ng-model-options="search.options"
                                       placeholder="{{ trans('afp-core::common.key_search') }}"
                                       ng-keyup="$event.keyCode == 13 && getSite()">
                            </md-input-container>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('category', categoryFilter)" ng-model="categoryFilter"
                                       aria-label="Danh mục" placeholder="Danh mục" style="width: 100%">
                                <md-option value="">Show all</md-option>
                                <md-option ng-value="category.category_id"
                                           ng-repeat="category in categoryListFilter">@{{category.name}}</md-option>
                            </md-select>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('tag', tagFilter)" ng-model="tagFilter"
                                       aria-label="Tag" placeholder="Tag" style="width: 100%">
                                <md-option value="">Show all</md-option>
                                <md-option ng-value="tag.id" ng-repeat="tag in tagListFilter">@{{tag.name}}</md-option>
                            </md-select>
                        </md-grid-tile>
                        <md-grid-tile md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1">
                            <md-select ng-change="setFilter('status', statusFilter)" ng-model="statusFilter"
                                       aria-label="Trạng thái" placeholder="Trạng thái" style="width: 100%">
                                <md-option value="">Show all</md-option>
                                <md-option ng-value="status.id"
                                           ng-repeat="status in statusListFilter">@{{status.name}}</md-option>
                            </md-select>
                            <md-button class="md-icon-button pull-right" aria-label="Close" style="margin:0; padding:0px; height: 30px"
                                       ng-click="search.show = false; query.keyword=''; query.status=0; query.category=0; query.tag=0; getSite()">
                                <md-icon>close</md-icon>
                                <md-tooltip>Close</md-tooltip>
                            </md-button>
                        </md-grid-tile>
                    </md-grid-list>
                </div>
            </div>
            <md-table-container style="margin-top: 20px">
                <table md-table multiple ng-model="selected">
                    <thead md-head md-order="query.order">
                    <tr md-row>
                        <th md-column md-text width="40">{{ trans('afp-core::site.table.id') }}</th>
                        <th md-column md-text>{{ trans('afp-core::common.report.sitename') }}</th>
                        <th md-column md-text
                            style="text-align: right">{{ trans('afp-core::common.report.totalclick') }}</th>
                        <th md-column md-text
                            style="text-align: right">{{ trans('afp-core::common.report.realclick') }}</th>
                        <th md-column md-text
                            style="text-align: right">{{ trans('afp-core::common.report.clickao') }}</th>
                        <th md-column md-text
                            style="text-align: right">{{ trans('afp-core::common.report.pageview') }}</th>
                        <th md-column md-text
                            style="text-align: right">{{ trans('afp-core::common.report.impression') }}</th>
                        <th md-column md-text style="text-align: right">{{ trans('afp-core::common.report.ctr') }}</th>
                        <th md-column md-text
                            style="text-align: right">{{ trans('afp-core::common.report.price_sale') }}</th>
                        <th md-column md-text
                            style="text-align: right">{{ trans('afp-core::common.report.price_buy') }}</th>
                        <th md-column md-text
                            style="text-align: right">{{ trans('afp-core::common.report.money') }}</th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    <tr md-row ng-repeat="site in siteEmpty">
                        <td md-cell colspan="11" style="color: #c1c1c1;"><i>@{{site.name}}</i></td>
                    </tr>
                    <tr md-row md-auto-select ng-repeat="site in siteList">
                        <td md-cell md-text><b>@{{site.site_id}}</b></td>
                        <td md-cell><a ng-click="reportDetail(site.reportDetail)">@{{site.sitename}}</a></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.totalclick | rawHtml"></span></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.realclick | rawHtml"></span></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.clickao | rawHtml"></span></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.pageview | rawHtml"></span></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.impression | rawHtml"></span></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.ctr | rawHtml"></span></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.price_sale | rawHtml"></span></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.price_buy | rawHtml"></span></td>
                        <td md-cell style="text-align: right"><span class="txt-silver" ng-bind-html="site.money | rawHtml"></span></td>
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
{{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>--}}
{{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css"/>--}}
@endPush
@push('scripts-view')
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/public/moment.min.js?t=').time() }}"></script>
{{--<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/public/daterangepicker.js?t=').time() }}"></script>--}}
<script type="text/javascript">
    var coreSiteEmpty = $.parseJSON('{!! $jsonSiteEmptyString !!}'),
        coreSite = $.parseJSON('{!! $jsonSiteString !!}'),
        categoryList = $.parseJSON('{!! $categoryList !!}'),
        tagList = $.parseJSON('{!! $tagList !!}'),
        statusList = $.parseJSON('{!! $statusList !!}'),
        status = '{{ $status }}',
        tag = '{{ $tag }}',
        category = '{{ $category }}',
        keyword = '{{ $keyword }}',
        showBL = false;
    if (keyword.length > 0 || status != 0 || tag != 0 || category != 0) {
        showBL = true;
    }

    angular.module("AdtechApp")
        .run(function ($rootScope) {
            $rootScope.getSite = function () {
                var query = $rootScope.query;
                var url = '{{ route('afp.core.report.manage') }}',
                    params = ['page=' + query.page, 'limit=' + query.limit,
                        'keyword=' + query.keyword, 'status=' + query.status,
                        'category=' + query.category, 'tag=' + query.tag,
                        'begin=' + query.begin, 'end=' + query.end];
                AdtechApp.loading.show();
                window.location.href = (url + '?' + params.join('&'));
            };
            $rootScope.getSiteDate = function () {
                var start = moment($rootScope.query.begin);
                var end = moment($rootScope.query.end);
                $rootScope.query.begin = start.format('YYYY-MM-DD');
                $rootScope.query.end = end.format('YYYY-MM-DD');
                $rootScope.getSite();
            }
            $rootScope.export = {
                isOpen: false,
                selectedMode: 'md-fling',
                selectedDirection: 'down'
            }
            $rootScope.siteEmpty = coreSiteEmpty;
            $rootScope.siteList = coreSite;
            $rootScope.statusListFilter = statusList;
            $rootScope.statusFilter = parseInt(status);
            $rootScope.categoryListFilter = categoryList;
            $rootScope.categoryFilter = parseInt(category);
            $rootScope.tagListFilter = tagList;
            $rootScope.tagFilter = parseInt(tag);
            $rootScope.search = {
                options: {
                    debounce: 500
                },
                show: showBL
            };

            $rootScope.query = {
                keyword: keyword,
                category: category,
                status: status,
                tag: tag,
                filter: '',
                begin: '{{ $begin }}',
                end: '{{ $end }}',
                total: {{ $total }},
                limit: {{ $limit }},
                page: {{ $pageIndex }}
            };

            //pickdate
//            var start = moment($rootScope.query.begin);
//            var end = moment($rootScope.query.end);
//            $('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
//            function cb(start, end) {
//                $('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
//                $rootScope.query.begin = start.format('YYYY-MM-DD');
//                $rootScope.query.end = end.format('YYYY-MM-DD');
//                $rootScope.getSite();
//            }
//
//            $('#reportrange').daterangepicker({
//                startDate: start,
//                endDate: end,
//                ranges: {
//                    'Today': [moment(), moment()],
//                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//                    'This Month': [moment().startOf('month'), moment().endOf('month')],
//                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//                }
//            }, cb);
            //

            $rootScope.setFilter = function (typeFilter, filterStr) {
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
            $rootScope.reportDetail = function (url) {
                window.location.href = (url + '?begin=' + $rootScope.query.begin + '&end=' + $rootScope.query.end);
            };
        });

    angular.module("AdtechApp")
        .constant("CSRF_TOKEN", '{{ csrf_token() }}')
        .run(['$http', 'CSRF_TOKEN', function ($http, CSRF_TOKEN) {
            $http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
        }]);
</script>
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/report.js?t=').time() }}"></script>
@endPush