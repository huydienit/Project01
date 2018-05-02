@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.report.detail') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="reportCtrl">
        <md-card>
            <div class="box_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('afp.core.dashboard.index') }}">{{ trans('afp-core::labels.home') }}</a></li>
                    <li><a href="{{ route('afp.core.report.manage') }}">{{ trans('afp-core::labels.report') }}</a></li>
                    <li><h2 class="md-title">{{ $title }}</h2></li>
                </ul>
                <div class="action_breadcrumb" layout="row" style="top: 0; right:10px">
                    <div>
                        <md-datepicker ng-model="query.begin" ng-change="getSiteDate()" md-placeholder="Enter date begin"></md-datepicker>
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
            {{--<md-toolbar class="md-table-toolbar md-default">--}}
                {{--<div class="md-toolbar-tools no-form" layout="row">--}}
                    {{--<div flex></div>--}}
                    {{--<div flex="nogrow">--}}
                        {{--<div id="reportrange" class="pull-right"--}}
                             {{--style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; margin-top:10px">--}}
                            {{--<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;--}}
                            {{--<span></span> <b class="caret"></b>--}}
                        {{--</div>--}}
                        {{--<md-datepicker ng-model="query.begin" ng-change="getSiteDate()" md-placeholder="Enter date begin"></md-datepicker>--}}
                        {{--<md-datepicker ng-model="query.end" ng-change="getSiteDate()" md-placeholder="Enter date end"></md-datepicker>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</md-toolbar>--}}
            <div layout="row" style="overflow: hidden;">
                <div show-gt-sm flex-gt-sm="100" flex="0">
                    <div id="container_pc" style="width: 100%"></div>
                </div>
                <div hide-gt-sm flex-gt-sm="0" flex="100">
                    <div id="container" style="width: 100%"></div>
                </div>
            </div>


            <md-tabs md-dynamic-height md-border-bottom style="margin:10px; margin-top: 30px;">
                <md-tab label="Theo ngày">
                    <md-content class="md-padding">
                        <md-table-container>
                            <table md-table multiple ng-model="selected">
                                <thead md-head>
                                <tr md-row>
                                    <th md-column md-text>{{ trans('afp-core::common.report.date') }}</th>
                                    <th md-column md-text md-order-by="totalclick" ng-click="sortBy('totalclick')"
                                        style="text-align: right">{{ trans('afp-core::common.report.totalclick') }}</th>
                                    <th md-column md-text md-order-by="realclick" ng-click="sortBy('realclick')"
                                        style="text-align: right">{{ trans('afp-core::common.report.realclick') }}</th>
                                    <th md-column md-text md-order-by="clickao" ng-click="sortBy('clickao')"
                                        style="text-align: right">{{ trans('afp-core::common.report.clickao') }}</th>
                                    <th md-column md-text md-order-by="pageview" ng-click="sortBy('pageview')"
                                        style="text-align: right">{{ trans('afp-core::common.report.pageview') }}</th>
                                    <th md-column md-text md-order-by="impression" ng-click="sortBy('impression')"
                                        style="text-align: right">{{ trans('afp-core::common.report.impression') }}</th>
                                    <th md-column md-text md-order-by="ctr" ng-click="sortBy('ctr')"
                                        style="text-align: right">{{ trans('afp-core::common.report.ctr') }}</th>
                                    <th md-column md-text md-order-by="price_sale" ng-click="sortBy('price_sale')"
                                        style="text-align: right">{{ trans('afp-core::common.report.price_sale') }}</th>
                                    <th md-column md-text md-order-by="price_buy" ng-click="sortBy('price_buy')"
                                        style="text-align: right">{{ trans('afp-core::common.report.price_buy') }}</th>
                                    <th md-column md-text md-order-by="money" ng-click="sortBy('money')"
                                        style="text-align: right">{{ trans('afp-core::common.report.money') }}</th>
                                </tr>
                                </thead>
                                <tbody md-body>
                                <tr md-row ng-repeat="site in siteEmpty">
                                    <td md-cell colspan="10" style="color: #c1c1c1;"><i>@{{site.name}}</i></td>
                                </tr>
                                <tr md-row md-auto-select ng-repeat="site in siteList|orderBy:tblDate:reverse">
                                    <td md-cell><b>@{{site.date}}</b></td>
                                    <td md-cell style="text-align: right">@{{site.totalclick|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.realclick|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.clickao}}</td>
                                    <td md-cell style="text-align: right">@{{site.pageview|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.impression|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.ctr}}</td>
                                    <td md-cell style="text-align: right">@{{site.price_sale|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.price_buy|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.money|number}}</td>
                                </tr>
                                </tbody>
                                <tfoot md-foot>
                                <tr md-row ng-repeat="site in siteListTotal">
                                    <td md-cell><strong>Tổng: </strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.totalclick|number}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.realclick|number}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.clickao}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.pageview|number}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.impression|number}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.ctr}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.price_sale}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.price_buy}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.money|number}}</strong></td>
                                </tr>
                                </tfoot>
                            </table>
                        </md-table-container>
                    </md-content>
                </md-tab>
                <md-tab label="Theo box">
                    <md-content class="md-padding">
                        <md-table-container>
                            <table md-table multiple ng-model="selected">
                                <thead md-head>
                                <tr md-row>
                                    <th md-column md-text width="300">{{ trans('afp-core::common.report.zone_name') }}</th>
                                    <th md-column md-text md-order-by="totalclick" ng-click="sortByZone('totalclick')"
                                        style="text-align: right">{{ trans('afp-core::common.report.totalclick') }}</th>
                                    <th md-column md-text md-order-by="realclick" ng-click="sortByZone('realclick')"
                                        style="text-align: right">{{ trans('afp-core::common.report.realclick') }}</th>
                                    <th md-column md-text md-order-by="clickao" ng-click="sortByZone('clickao')"
                                        style="text-align: right">{{ trans('afp-core::common.report.clickao') }}</th>
                                    <th md-column md-text md-order-by="pageview" ng-click="sortByZone('pageview')"
                                        style="text-align: right">{{ trans('afp-core::common.report.pageview') }}</th>
                                    <th md-column md-text md-order-by="impression" ng-click="sortByZone('impression')"
                                        style="text-align: right">{{ trans('afp-core::common.report.impression') }}</th>
                                    <th md-column md-text md-order-by="ctr" ng-click="sortByZone('ctr')"
                                        style="text-align: right">{{ trans('afp-core::common.report.ctr') }}</th>
                                    <th md-column md-text md-order-by="price_sale" ng-click="sortByZone('price_sale')"
                                        style="text-align: right">{{ trans('afp-core::common.report.price_sale') }}</th>
                                    <th md-column md-text md-order-by="price_buy" ng-click="sortByZone('price_buy')"
                                        style="text-align: right">{{ trans('afp-core::common.report.price_buy') }}</th>
                                    <th md-column md-text md-order-by="money" ng-click="sortByZone('money')"
                                        style="text-align: right">{{ trans('afp-core::common.report.money') }}</th>
                                </tr>
                                </thead>
                                <tbody md-body>
                                <tr md-row ng-repeat="site in siteZoneEmpty">
                                    <td md-cell colspan="10" style="color: #c1c1c1;"><i>@{{site.name}}</i></td>
                                </tr>
                                <tr md-row md-auto-select ng-repeat="site in siteZoneList|orderBy:tblZone:reverse">
                                    <td md-cell><b>@{{site.zone_name}}</b></td>
                                    <td md-cell style="text-align: right">@{{site.totalclick|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.realclick|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.clickao}}</td>
                                    <td md-cell style="text-align: right">@{{site.pageview|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.impression|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.ctr}}</td>
                                    <td md-cell style="text-align: right">@{{site.price_sale|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.price_buy|number}}</td>
                                    <td md-cell style="text-align: right">@{{site.money|number}}</td>
                                </tr>
                                </tbody>
                                <tfoot md-foot>
                                <tr md-row ng-repeat="site in siteZoneTotal">
                                    <td md-cell><strong>Tổng: </strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.totalclick|number}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.realclick|number}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.clickao}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.pageview|number}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.impression|number}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.ctr}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.price_sale}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.price_buy}}</strong></td>
                                    <td md-cell style="text-align: right"><strong>@{{site.money|number}}</strong></td>
                                </tr>
                                </tfoot>
                            </table>
                        </md-table-container>
                    </md-content>
                </md-tab>
            </md-tabs>
        </md-card>
    </div>
@stop
@push('scripts-view')
{{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>--}}
{{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css"/>--}}
<style type="text/css">
    .md-table-pagination .label {
        color: rgba(0, 0, 0, .54) !important;
        font-size: 100% !important;
        font-weight: normal !important;
    }
    .chart {
        height: 250px;
        margin: 0 auto;
    }
    #container_pc .highcharts-container {
        width: 100% !important;
    }
</style>
@endPush
@push('scripts-view')
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/public/moment.min.js?t=').time() }}"></script>
{{--<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/public/daterangepicker.js?t=').time() }}"></script>--}}
<script type="text/javascript">
    var coreSiteEmpty = $.parseJSON('{!! $jsonSiteEmptyString !!}'),
        coreSiteZoneEmpty = $.parseJSON('{!! $jsonSiteZoneEmptyString !!}'),
        coreSite = $.parseJSON('{!! $jsonSiteString !!}'),
        coreSiteZone = $.parseJSON('{!! $jsonSiteZoneString !!}'),
        siteZoneTotal = $.parseJSON('{!! $jsonSiteZoneTotal !!}'),
        siteListTotal = $.parseJSON('{!! $jsonSiteListTotal !!}'),
        xData = $.parseJSON('{!! $xData !!}'),
        dataMoney = $.parseJSON('{!! $dataMoney !!}'),
        dataImp = $.parseJSON('{!! $dataImp !!}'),
        dataClick = $.parseJSON('{!! $dataClick !!}'),
        charData = $.parseJSON('{!! $charData !!}'),
        begin = '{{ $begin }}',
        startDate = new Date(begin).getTime(),
        showBL = true;

    angular.module("AdtechApp")
        .run(function ($rootScope) {
            $rootScope.getSite = function ($bl) {
                var query = $rootScope.query;
                var url = '{{ route('afp.core.report.detail', $site_id) }}',
                    params = ['begin=' + query.begin, 'end=' + query.end];
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
            $rootScope.siteEmpty = coreSiteEmpty;
            $rootScope.siteZoneEmpty = coreSiteZoneEmpty;
            $rootScope.siteList = coreSite;
            $rootScope.siteZoneList = coreSiteZone;
            $rootScope.siteZoneTotal = siteZoneTotal;
            $rootScope.siteListTotal = siteListTotal;
            $rootScope.search = {
                options: {
                    debounce: 500
                },
                show: showBL
            };

            $rootScope.query = {
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
                $rootScope.getSite();
            };
            $rootScope.reportDetail = function (url) {
                window.location.href = (url);
            };
        });

    angular.module("AdtechApp")
        .constant("CSRF_TOKEN", '{{ csrf_token() }}')
        .run(['$http', 'CSRF_TOKEN', function ($http, CSRF_TOKEN) {
            $http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
        }]);
</script>
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/report-detail.js?t=').time() }}"></script>
@endPush