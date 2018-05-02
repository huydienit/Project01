@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.sync.title') }}@stop

@section('content')
    <div layout-no-padding="" ng-controller="syncCtrl">
        <md-card>
            <md-toolbar class="md-table-toolbar md-default">
                <div class="md-toolbar-tools">
                    <h2 class="md-title">{{ $title }}</h2>
                    <div flex></div>
                </div>
            </md-toolbar>
            <div ng-repeat="item in syncList" style="padding-left: 30px">
                <md-checkbox ng-checked="exists(item.id, selected)" ng-click="toggle(item.id, selected)">
                    @{{ item.name }}
                </md-checkbox>
            </div>
            <md-button ng-click="syncData()" class="md-raised md-primary">
                {{ trans('afp-core::buttons.sync') }}
            </md-button>
        </md-card>
    </div>
@stop
@push('scripts-view')
<script src="http://dev.afp.vn/vendor/afp-cms/default/js/config.js?t={{ time() }}"></script>
<script src="http://dev.afp.vn/vendor/afp-cms/default/js/services.js?t={{ time() }}"></script>
<script src="http://dev.afp.vn/vendor/afp-cms/default/js/controllers/sync.js?t={{ time() }}"></script>
@endPush