@extends('layouts.default')
@section('title'){{ $title = trans('afp-core::titles.route.manage') }}@stop
@section('content')
    <div layout-no-padding="">
        <md-card>
            <div class="box_breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="{{ route('afp.core.dashboard.index') }}">Home</a></li>
                    <li><h2 class="md-title">{{ $title }}</h2></li>
                </ul>
            </div>
        </md-card>
        <md-card style="padding-top: 10px">
            <md-table-container style="margin: 20px 0px">
                <table md-table md-row-select multiple>
                    <thead md-head md-order="query.order" md-on-reorder="getRoles">
                    <tr md-row>
                        <th width="20" md-column><span>{{ $labelId = trans('afp-core::common.sequence') }}</span></th>
                        <th md-column md-text md-order-by="role.name">
                            <span>{{ $labelName = trans('afp-core::common.route.name') }}</span></th>
                        <th md-column md-text md-order-by="role.uri">
                            <span>{{ $labelURI = trans('afp-core::common.route.uri') }}</span></th>
                        <th md-column md-text md-order-by="role.controller">
                            <span>{{ $labelURI = trans('afp-core::common.route.controllerAction') }}</span></th>
                        <th md-column><span>{{ $labelMiddleware = trans('afp-core::common.route.middleware') }}</span>
                        </th>
                        <th md-column><span>{{ $labelMethod = trans('afp-core::common.route.method') }}</span></th>
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

            <md-table-pagination md-label="{page: '{{ trans('afp-core::labels.page') }}', rowsPerPage: '{{ trans('afp-core::labels.rowsPerPage') }}', of: '{{ trans('afp-core::labels.of') }}'}"
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
