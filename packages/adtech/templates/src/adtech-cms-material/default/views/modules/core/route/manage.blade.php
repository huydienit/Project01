@extends('layouts.default')
@section('title'){{ $title = trans('adtech-core::titles.route.manage') }}@stop
@section('content')
    <div layout-no-padding="">
        <md-card>
            <md-toolbar class="md-table-toolbar md-default" ng-hide="selected.length || filter.show">
                <div class="md-toolbar-tools">
                    <h2 class="md-title">{{ $title }}</h2>
                    <div flex></div>
                    <md-button class="md-icon-button" ng-click="addItem($event)">
                        <md-icon>add_box</md-icon>
                        <md-tooltip>{{ trans('adtech-core::buttons.add_new_role') }}</md-tooltip>
                    </md-button>
                </div>
            </md-toolbar>

            <md-toolbar class="md-table-toolbar alternate" ng-show="selected.length">
                <div class="md-toolbar-tools" layout-align="space-between">
                    <div>@{{selected.length}} @{{selected.length > 1 ? 'items' : 'item'}} selected</div>
                    <md-button class="md-icon-button" ng-click="delete($event)">
                        <md-icon>delete</md-icon>
                    </md-button>
                </div>
            </md-toolbar>

            <md-table-container>
                <table md-table md-row-select multiple ng-model="selected" md-progress="promise">
                    <thead md-head md-order="query.order" md-on-reorder="getRoles">
                    <tr md-row>
                        <th width="20" md-column><span>{{ $labelId = trans('adtech-core::common.sequence') }}</span>
                        </th>
                        <th md-column md-text md-order-by="role.name">
                            <span>{{ $labelName = trans('adtech-core::common.route.name') }}</span></th>
                        <th md-column md-text md-order-by="role.uri">
                            <span>{{ $labelURI = trans('adtech-core::common.route.uri') }}</span></th>
                        <th md-column md-text md-order-by="role.controller">
                            <span>{{ $labelURI = trans('adtech-core::common.route.controllerAction') }}</span></th>
                        <th md-column>
                            <span>{{ $labelMiddleware = trans('adtech-core::common.route.middleware') }}</span></th>
                        <th md-column><span>{{ $labelMethod = trans('adtech-core::common.route.method') }}</span></th>
                    </tr>
                    </thead>
                    <tbody md-body>
                    @foreach ($routes['routes'] as $k => $route)
                        <tr md-row md-select="" md-select-id="role.id" md-auto-select>
                            <td md-cell>{{ $k + 1 }}</td>
                            <td md-cell>
                                @if (isset($route->action['as']))
                                    {{ $route->action['as'] }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td md-cell>
                                <div>{{ $route->uri }}</div>
                                @if ($route->wheres)
                                    @foreach ($route->wheres as $k => $v)
                                        <div>{{ $k }}: {{ $v }}</div>
                                    @endforeach
                                @endif
                            </td>
                            <td md-cell>
                                @if (isset($route->action['controller']))
                                    {{ $route->action['controller'] }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td md-cell>
                                @if (isset($route->action['middleware']))
                                    @if (is_array($route->action['middleware']))
                                        {{ implode(', ', $route->action['middleware']) }}
                                    @else
                                        {{ $route->action['middleware'] }}@endif
                                @endif
                            </td>
                            <td md-cell>{{ implode(', ', $route->methods) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </md-table-container>

            <md-table-pagination md-label="{page: 'Page', rowsPerPage: 'Rows per page', of: 'of'}"
                                 md-limit="{{ $limit }}" md-limit-options="[10, 30, 50, 100]" md-page="{{ $pageIndex }}"
                                 md-total="{{ count($routes) }}" md-on-paginate="getRoles"
                                 md-page-select></md-table-pagination>
        </md-card>
    </div>
@stop

@push('scripts-view')
<script type="text/javascript">
    angular.module("AdtechApp")
        .run(function ($rootScope) {

        });
</script>
@endPush
