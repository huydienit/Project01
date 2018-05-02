@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.payment.manage') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="paymentCtrl">
        <md-fab-speed-dial ng-hide="false" md-direction="left" md-open="export.isOpen"
                           style="position: fixed; bottom: 25px; right: 82; height: 60px; padding-right:70px"
                           class="md-scale" ng-class="{ 'md-hover-full': export.hover }"
                           ng-mouseenter="export.isOpen=true" ng-mouseleave="export.isOpen=false">
            <md-fab-trigger>
                <md-button class="md-fab md-raised md-warn" ng-click="exportExcel()"
                           style="position: fixed; bottom:20px; right: 82px">
                    <i class="material-icons">&#xE2C4;</i></md-button>
                </md-button>
            </md-fab-trigger>

            <md-fab-actions>
                <md-button aria-label="Export report all site" class="md-fab md-raised">
                    <label style="cursor: pointer">
                        <md-tooltip md-direction="top">
                            Chọn file cần cập nhật thanh toán.
                        </md-tooltip>
                        <i class="material-icons" style="font-size: 40px; color: #1E88E5">&#xE2C3;</i>
                        <input type="file" file-model="myFile" id="myFile" class="ng-hide"
                               onchange="angular.element(this).scope().selectFile(this)"/>
                    </label>
                </md-button>
            </md-fab-actions>
        </md-fab-speed-dial>
        <md-card>
            <div class="box_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('afp.core.dashboard.index') }}">{{ trans('afp-core::labels.home') }}</a></li>
                    <li><h2 class="md-title">{{ $title }}</h2></li>
                </ul>
                <div class="action_breadcrumb" layout="row">
                    <md-select ng-change="setFilter('month', monthFilter)" ng-model="monthFilter" aria-label="Month"
                               placeholder="Month"
                               style="width: 120px; text-align: center; margin:0px; height: 30px; line-height: 30px">
                        <md-option ng-value="month.id" ng-repeat="month in monthListFilter">@{{month.name}}</md-option>
                    </md-select>
                    &nbsp;&nbsp;
                    <md-select ng-change="setFilter('year', yearFilter)" ng-model="yearFilter" aria-label="Year"
                               placeholder="Year"
                               style="width: 120px; text-align: center; margin:0px; height: 30px; line-height: 30px">
                        <md-option ng-value="year.id" ng-repeat="year in yearListFilter">@{{year.name}}</md-option>
                    </md-select>

                    <md-button class="md-icon-button no-bg" aria-label="Search" style="min-width: 30px"
                               ng-click="getSite()">
                        <md-icon style="font-size: 24px">search</md-icon>
                    </md-button>
                </div>
            </div>
        </md-card>
        <md-card style="padding-top: 10px">

            {{--<section layout="row" layout-align="end center" layout-wrap style="margin-top: 20px">--}}
            {{--<div style="display: inline; position: relative; margin-right: 5px">--}}
            {{--<label style="cursor: pointer" ng-click="showEditMail()">--}}
            {{--<md-tooltip md-direction="bottom">--}}
            {{--Danh sách mail nhận file thanh toán--}}
            {{--</md-tooltip>--}}
            {{--<i class="material-icons" style="font-size: 40px; color:#81B84F">&#xE0BE;</i>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--<div style="display: inline; position: relative">--}}
            {{--<label style="cursor: pointer">--}}
            {{--<md-tooltip md-direction="bottom">--}}
            {{--Chọn file cần cập nhật thanh toán.--}}
            {{--</md-tooltip>--}}
            {{--<i class="material-icons" style="font-size: 40px; color: #1E88E5">&#xE2C3;</i>--}}
            {{--<input type="file" file-model="myFile" id="myFile" class="ng-hide" onchange="angular.element(this).scope().selectFile(this)"/>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--<div style="display: inline">--}}
            {{--<md-tooltip md-direction="bottom">--}}
            {{--Bấm vào đây để cập nhật dữ liệu thanh toán theo file đã chọn.--}}
            {{--</md-tooltip>--}}
            {{--<md-button class="md-raised md-primary" ng-click="uploadFile()" ng-show="checkUploadFile">Cập nhật</md-button>--}}
            {{--</div>--}}
            {{--<div style="display: inline">--}}
            {{--<md-tooltip md-direction="bottom">--}}
            {{--Bấm vào đây để tải file thanh toán kỳ.--}}
            {{--</md-tooltip>--}}
            {{--<md-button ng-click="exportExcel()" class="md-raised md-warn" style="color: white">Xuất excel</md-button>--}}
            {{--</div>--}}
            {{--</section>--}}

            <md-table-container style="margin:20px 0px 20px 0px;">
                <table md-table multiple>
                    <thead md-head>
                    <tr md-row>
                        <th md-column md-text><span>{{ $labelId = trans('afp-core::common.payment.sitename') }}</span>
                        </th>
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.payment.thoigian') }}</span>
                        </th>
                        <th md-column style="text-align: right">
                            <span>{{ $labelName = trans('afp-core::common.payment.money') }}</span>
                        </th>
                        <th md-column style="text-align: right">
                            <span>{{ $labelName = trans('afp-core::common.payment.sotien') }}</span>
                        </th>
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.payment.status') }}</span>
                        </th>
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.payment.note') }}</span>
                        </th>
                        <th md-column md-text><span>{{ $labelName = trans('afp-core::common.payment.note_pub') }}</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    <tr md-row md-auto-select ng-repeat="site in siteList">
                        <td md-cell><a class="link" href="/admin/afp/core/site/manage?page=1&limit=30&status=0&keyword=&category=0&tag=0&type=0&edit=1&site_id=@{{site.id}}">@{{site.sitename}}</a></td>
                        <td md-cell><a
                                    ng-click="reportDetail(site.reportDetail, site.begin, site.end)">@{{site.thoigian}}</a>
                        </td>
                        <td md-cell style="text-align: right">@{{site.money|number}}</td>
                        <td md-cell style="text-align: right">@{{site.sotien|number}}</td>
                        <td md-cell>@{{site.status}}</td>
                        <td md-cell>@{{site.note}}</td>
                        <td md-cell>@{{site.note_pub}}</td>
                    </tr>
                    </tbody>
                </table>
            </md-table-container>
            <md-table-pagination
                    md-label="{page: '{{ trans('afp-core::labels.page') }}', rowsPerPage: '{{ trans('afp-core::labels.rowsPerPage') }}', of: '{{ trans('afp-core::labels.of') }}'}"
                    md-limit="query.limit" md-limit-options="[10, 30, 50, 100]" md-page="query.page"
                    md-total="@{{ query.total }}" md-on-paginate="getSite"
                    md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop
@push('scripts-view')
{{--<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/public/moment.min.js?t=').time() }}"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/danialfarid-angular-file-upload/9.0.9/ng-file-upload.min.js"></script>--}}
<script type="text/javascript">
    var coreSiteEmpty = $.parseJSON('{!! $jsonSiteEmptyString !!}'),
        coreSite = $.parseJSON('{!! $jsonSiteString !!}'),
        monthList = $.parseJSON('{!! $monthList !!}'),
        yearList = $.parseJSON('{!! $yearList !!}'),
        monthFilter = parseInt('{{ $monthFilter }}'),
        yearFilter = parseInt('{{ $yearFilter }}'),
        showBL = true;

    angular.module("AdtechApp")
        .constant("CSRF_TOKEN", '{{ csrf_token() }}')
        .run(['$http', 'CSRF_TOKEN', function ($http, CSRF_TOKEN) {
            $http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
        }]);

    angular.module("AdtechApp")
        .run(function ($rootScope, $http, $mdToast) {
            $rootScope.getSite = function ($bl) {
                var query = $rootScope.query;
                var url = '{{ route('afp.core.payment.manage') }}',
                    params = ['page=' + query.page, 'limit=' + query.limit, 'month=' + query.year + '-' + query.month];
                AdtechApp.loading.show();
                window.location.href = (url + '?' + params.join('&'));
            };
            $rootScope.showEditMail = function ($bl) {
                var url = '{{ route('afp.core.payment-mail.manage') }}';
                AdtechApp.loading.show();
                window.location.href = (url);
            };
            $rootScope.export = {
                isOpen: false,
                selectedMode: 'md-fling',
                selectedDirection: 'down'
            }

            $rootScope.siteEmpty = coreSiteEmpty;
            $rootScope.siteList = coreSite;
            $rootScope.monthListFilter = monthList;
            $rootScope.yearListFilter = yearList;
            $rootScope.monthFilter = monthFilter;
            $rootScope.yearFilter = yearFilter;
            $rootScope.search = {
                options: {
                    debounce: 500
                },
                show: showBL
            };

            $rootScope.query = {
                filter: '',
                month: monthFilter,
                year: yearFilter,
                total: {{ $total }},
                limit: {{ $limit }},
                page: {{ $pageIndex }}
            };

            $rootScope.setFilter = function (typeFilter, filterStr) {
                if (typeFilter == 'month') {
                    $rootScope.query.month = filterStr;
                }
                if (typeFilter == 'year') {
                    $rootScope.query.year = filterStr;
                }
                $rootScope.getSite();
            };

            $rootScope.reportDetail = function (url, begin, end) {
                window.location.href = (url + '?begin=' + begin + '&end=' + end);
            };
            $rootScope.exportExcel = function () {
                var query = $rootScope.query;
                $http({
                    method: 'POST',
                    url: 'exportExcel',
                    headers: {'Content-Type': 'application/json; charset=UTF-8'},
                    data: {
                        month: query.year + '-' + query.month
                    }
                }).success(function (response) {
                    console.log(response);
                    if (response.success == true) {
                        document.location.href = (response.url);
                        $mdToast.show(
                            $mdToast.simple()
                                .textContent('Xuất file thành công')
                                .theme("success-toast")
                                .position('top right')
                                .action('⛌')
                        );
                    }
                    else {
                        $mdToast.show(
                            $mdToast.simple()
                                .textContent('Xuất file không thành công')
                                .theme("error-toast")
                                .position('top right')
                                .action('⛌')
                        );
                    }
                });
            };
        });
</script>
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/payment.js?t=').time() }}"></script>

@endPush