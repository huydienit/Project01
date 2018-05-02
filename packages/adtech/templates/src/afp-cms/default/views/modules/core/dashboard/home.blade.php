@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.dashboard.home') }}@stop
@section('content')
    <div layout-no-padding="" ng-controller="homeCtrl">
        <md-content class="md-padding" style="padding-bottom:5px;">
            <md-card style="padding:10px; min-height: 150px;">
                <md-grid-list class="box_total" style="min-height: 150px"
                              md-cols="1" md-cols-sm="2" md-cols-gt-sm="4"
                              md-row-height-gt-sm="4:1" md-row-height="4:1"
                              md-gutter="10px">

                    <md-grid-tile md-rowspan="2" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1"
                                  class="bg-danger">
                        <md-grid-tile-header>
                            <i class="material-icons">timeline</i>
                        </md-grid-tile-header>
                        <md-grid-tile-content>
                            <h3><a style="color: white; text-decoration: none" href="{{ route("afp.core.report.manage") }}">{{number_format($total1)}}</a></h3>
                        </md-grid-tile-content>
                        <md-grid-tile-footer>
                            <h3>CPC trong ngày</h3>
                            <p>
                            <?php if ($total1>0 && $total2>0) : ?>

                                <i class="material-icons"><?php echo ($total1 >= $total2) ? 'trending_up' : 'trending_down' ?></i>&nbsp;
                                {{ round((($total1 - $total2) / $total2) * 100, 0) }}
                                % <?php echo ($total1 >= $total2) ? 'Higher' : 'Lower' ?> than yesterday

                            <?php endif; ?>
                                &nbsp;</p>
                        </md-grid-tile-footer>
                    </md-grid-tile>
                    <md-grid-tile md-rowspan="2" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1"
                                  class="bg-info">
                        <md-grid-tile-header>
                            <i class="material-icons">equalizer</i>
                        </md-grid-tile-header>
                        <md-grid-tile-content>
                            <h3><a style="color: white; text-decoration: none" href="{{ route("afp.core.report.manage", ['begin' => date('Y/m/d',strtotime("-1 days")), 'end' => date('Y/m/d',strtotime("-1 days"))]) }}">{{($total2>1)?number_format($total2):0}}</a></h3>
                        </md-grid-tile-content>
                        <md-grid-tile-footer>
                            <h3>CPC hôm qua</h3>
                            <p>&nbsp;</p>
                        </md-grid-tile-footer>
                    </md-grid-tile>

                    <md-grid-tile md-rowspan="2" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1"
                                  class="bg-warning ">
                        <md-grid-tile-header>
                            <i class="material-icons">timeline</i>
                        </md-grid-tile-header>
                        <md-grid-tile-content>
                            <h3><a style="color: white; text-decoration: none" href="{{ route("afp.core.report.manage", ['begin' => date('Y/m/d'), 'end' => date('Y/m/t')]) }}">{{number_format($total3)}}</a></h3>
                        </md-grid-tile-content>
                        <md-grid-tile-footer>
                            <h3>CPC tháng này</h3>
                            <p>
                            <?php if($total3>0 && $total4>0) : ?>

                                <i class="material-icons"><?php echo ($total3 >= $total4) ? 'trending_up' : 'trending_down' ?></i>&nbsp;
                                {{ round((($total3 - $total4)/$total4) * 100, 0) }}
                                % <?php echo ($total3 >= $total4) ? 'Higher' : 'Lower' ?> than last month

                            <?php endif; ?>
                                &nbsp;</p>
                        </md-grid-tile-footer>
                    </md-grid-tile>

                    <md-grid-tile md-rowspan="2" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1"
                                  class="bg-success">
                        <md-grid-tile-header>
                            <i class="material-icons">equalizer</i>
                        </md-grid-tile-header>
                        <md-grid-tile-content>
                            <h3><a style="color: white; text-decoration: none" href="{{ route("afp.core.report.manage", ['begin' => date('Y/m/d',strtotime("-1 month")), 'end' => date('Y/m/d',strtotime("-1 month"))]) }}">{{($total4>1)?number_format($total4):0}}</a></h3>
                        </md-grid-tile-content>
                        <md-grid-tile-footer>
                            <h3>CPC tháng trước</h3>
                            <p>&nbsp;</p>
                        </md-grid-tile-footer>
                    </md-grid-tile>
                </md-grid-list>
            </md-card>
        </md-content>
        <md-content class="md-padding" style="padding-bottom:5px; padding-top: 0px">
            <div layout-xs="column" layout-gt-xs="row">
                <div flex="grow">
                    <md-card style="padding:5px; height: 435px">
                        <md-toolbar class="md-table-toolbar md-default">
                            <div class="md-toolbar-tools">
                                <span style="font-size: 18px">Site đăng ký</span>
                            </div>
                        </md-toolbar>
                        <md-table-container>
                            <table md-table multiple>
                                <thead md-head>
                                <tr md-row>
                                    <th md-column md-text width="40px">{{ $labelEmail = trans('afp-core::labels.id') }}</th>
                                    <th md-column md-text>{{ $labelEmail = trans('afp-core::labels.domain') }}</th>
                                    <th md-column md-text>{{ $labelFirstName = trans('afp-core::labels.account') }}</th>
                                    <th md-column md-numeric width="60">{{ $labelAction = trans('afp-core::common.action') }}</th>
                                </tr>
                                </thead>
                                <tbody md-body>
                                <tr md-row ng-repeat="site in siteEmpty">
                                    <td md-cell colspan="6" style="color: #c1c1c1;"><i>@{{site.name}}</i></td>
                                </tr>
                                <tr md-row md-auto-select ng-repeat="site in sitedk">
                                    <td md-cell>@{{site.id}}</td>
                                    <td md-cell><a class="link" href="/admin/afp/core/site/manage?page=1&limit=30&status=3&keyword=&category=0&tag=0&type=0&edit=1&site_id=@{{site.id}}">@{{site.sitename}}</a></td>
                                    <td md-cell>@{{site.username}}</td>
                                    <td md-cell>
                                        <md-switch
                                                ng-change="onChangeStatusDK($event, '@{{site.id}}')"
                                                ng-model="site.statusLB" aria-label="Status"
                                                style="float:right"></md-switch>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </md-table-container>
                        <md-table-pagination md-label="{page: '{{ trans('afp-core::labels.page') }}', rowsPerPage: '{{ trans('afp-core::labels.rowsPerPage') }}', of: '{{ trans('afp-core::labels.of') }}'}"
                                             md-limit="query.limit" md-limit-options="[5, 10, 30, 50, 100]"
                                             md-page="query.page" md-total="@{{ query.total }}" md-on-paginate="getSiteDK"
                                             md-page-select></md-table-pagination>
                    </md-card>
                </div>
                <div flex="grow">
                    <md-card style="padding:10px;">
                        <div id="container"></div>
                    </md-card>
                </div>
            </div>
        </md-content>
    </div>
@stop
@push('scripts-view')
<script type="text/ng-template" id="frm-edit-site">
    <md-dialog flex="60">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{ trans('afp-core::site.add') }}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="closeDialog()">&#9932;</md-button>
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
            <md-button ng-click="showDel($event, site.site_id, site.sitename)"
                       class="md-raised md-warn">{{trans('afp-core::buttons.delete')}}</md-button>
            <md-button ng-click="updateSite()" ng-disabled="myForm.$invalid"
                       class="md-raised md-primary">{{trans('afp-core::buttons.save')}}</md-button>
        </md-dialog-actions>
    </md-dialog>
</script>
<script type="text/javascript">
    var listSiteEmpty = $.parseJSON('{!! $listSiteEmpty !!}'),
        listSiteDK = $.parseJSON('{!! $listSiteDK !!}'),
        chartData = $.parseJSON('{!! $chartData !!}'),
        categories = $.parseJSON('{!! $categories !!}'),
        categoryList = $.parseJSON('{!! $categoryList !!}'),
        tagList = $.parseJSON('{!! $tagList !!}'),
        total = '{{ $total }}',
        limit = '{{ $limit }}';
</script>
<script src="{{ url('/vendor/' . $group_name . '/' . $skin . '/js/controllers/dashboard.js?t=').time() }}"></script>
@endPush

@section('styles-more')
    <style type="text/css">

    </style>
@stop