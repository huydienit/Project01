@extends('layouts.default')
@section('content')
    <div layout-no-padding="" ng-controller="homeCtrl">
        <md-content class="md-padding" style="padding-bottom:5px">
            <md-card style="padding:10px">
                <md-grid-list class="box_total"
                              md-cols="1" md-cols-sm="2" md-cols-md="3" md-cols-gt-md="20"
                              md-row-height-gt-md="1:1" md-row-height="4:1"
                              md-gutter="8px" md-gutter-gt-sm="4px">

                    <md-grid-tile md-rowspan="2" md-colspan="5" md-colspan-sm="1" md-colspan-xs="1" class="bg-danger">
                        <md-grid-tile-header>
                            <i class="material-icons">timeline</i>
                        </md-grid-tile-header>
                        <md-grid-tile-content>
                            <h3>{{number_format($total1)}}</h3>
                        </md-grid-tile-content>
                        <md-grid-tile-footer>
                            <h3>CPC trong ngày</h3>
                            <p>
                                <i class="material-icons"><?php echo ($total1 >= $total2) ? 'trending_up' : 'trending_down' ?></i>&nbsp;{{ round((($total1-$total2)/$total2)*100,0) }}
                                % <?php echo  ($total1 >= $total2) ? 'Higher' : 'Lower' ?> than yesterday</p>
                        </md-grid-tile-footer>
                    </md-grid-tile>
                    <md-grid-tile md-rowspan="2" md-colspan="5" md-colspan-sm="1" md-colspan-xs="1" class="bg-info">
                        <md-grid-tile-header>
                            <i class="material-icons">equalizer</i>
                        </md-grid-tile-header>
                        <md-grid-tile-content>
                            <h3>{{number_format($total2)}}</h3>
                        </md-grid-tile-content>
                        <md-grid-tile-footer>
                            <h3>CPC hôm qua</h3>
                            <p>&nbsp;</p>
                        </md-grid-tile-footer>
                    </md-grid-tile>

                    <md-grid-tile md-rowspan="2" md-colspan="5" md-colspan-sm="1" md-colspan-xs="1" class="bg-warning ">
                        <md-grid-tile-header>
                            <i class="material-icons">timeline</i>
                        </md-grid-tile-header>
                        <md-grid-tile-content>
                            <h3>{{number_format($total3)}}</h3>
                        </md-grid-tile-content>
                        <md-grid-tile-footer>
                            <h3>CPC tháng này</h3>
                            <p>
                                <i class="material-icons"><?php echo  ($total1 >= $total2) ? 'trending_up' : 'trending_down' ?></i>&nbsp;{{ round((($total3-$total4)/$total4)*100,0) }}
                                % <?php echo  ($total1 >= $total2) ? 'Higher' : 'Lower' ?> than last month</p>
                        </md-grid-tile-footer>
                    </md-grid-tile>

                    <md-grid-tile md-rowspan="2" md-colspan="5" md-colspan-sm="1" md-colspan-xs="1" class="bg-success">
                        <md-grid-tile-header>
                            <i class="material-icons">equalizer</i>
                        </md-grid-tile-header>
                        <md-grid-tile-content>
                            <h3>{{number_format($total4)}}</h3>
                        </md-grid-tile-content>
                        <md-grid-tile-footer>
                            <h3>CPC tháng trước</h3>
                            <p>&nbsp;</p>
                        </md-grid-tile-footer>
                    </md-grid-tile>
                </md-grid-list>
            </md-card>
        </md-content>
        <md-content class="md-padding" layout-xs="column" layout="row" style="padding-top:0">
            <div flex-xs flex-gt-xs="50" layout="column">
                <md-card style="padding:10px">
                    <md-toolbar class="md-table-toolbar md-default">
                        <div class="md-toolbar-tools">
                            <span>Site đăng ký</span>
                        </div>
                    </md-toolbar>
                    <md-table-container>
                        <table md-table multiple md-progress="promise">
                            <thead md-head>
                            <tr md-row>
                                <th md-column md-text
                                    md-order-by="email">{{ $labelEmail = trans('adtech-core::labels.domain') }}</th>
                                <th md-column md-text
                                    md-order-by="username">{{ $labelFirstName = trans('adtech-core::labels.account') }}</th>
                                <th align="center" md-column
                                    md-numeric>{{ $labelAction = trans('adtech-core::common.action') }}</th>
                            </tr>
                            </thead>
                            <tbody md-body>
                            <tr md-row md-auto-select ng-repeat="site in sitedk">
                                <td md-cell class="md-cell ng-binding">@{{site.domain}}</td>
                                <td md-cell>@{{site.username}}</td>
                                <td md-cell>
                                    <md-switch aria-label="Status" style="float:right"></md-switch>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </md-table-container>
                </md-card>
            </div>
            <div flex-xs flex-gt-xs="50" layout="column">
                <md-card style="padding:10px">
                    <md-toolbar class="md-table-toolbar md-default">
                        <div class="md-toolbar-tools">
                            <span>Kích hoạt ADX</span>
                        </div>
                    </md-toolbar>
                    <md-table-container>
                        <table md-table multiple md-progress="promise">
                            <thead md-head>
                            <tr md-row>
                                <th md-column md-text
                                    md-order-by="email">{{ $labelEmail = trans('adtech-core::labels.domain') }}</th>
                                <th md-column md-text>{{ $labelFirstName = trans('adtech-core::labels.ga') }}</th>
                                <th align="center" md-column
                                    md-numeric>{{ $labelAction = trans('adtech-core::common.action') }}</th>
                            </tr>
                            </thead>
                            <tbody md-body>
                            <tr md-row md-auto-select ng-repeat="site in siteadx">
                                <td md-cell>@{{site.sitename}}</td>
                                <td md-cell></td>
                                <td md-cell>
                                    <md-switch aria-label="Status" style="float:right"></md-switch>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </md-table-container>
                </md-card>
            </div>
        </md-content>
    </div>
@stop
@push('scripts-view')
<script src="http://dev.afp.vn/vendor/adtech-cms-material/default/js/config.js?t={{ time() }}"></script>
<script src="http://dev.afp.vn/vendor/adtech-cms-material/default/js/services.js?t={{ time() }}"></script>
<script type="text/javascript">
    var listSiteDK = $.parseJSON('{!! $listSiteDK !!}');
    var listSiteADX = $.parseJSON('{!! $listSiteADX !!}');
</script>
<script src="http://dev.afp.vn/vendor/adtech-cms-material/default/js/controllers/dashboard.js?t={{ time() }}"></script>
@endPush

@section('styles-more')
    <style type="text/css">

    </style>
@stop