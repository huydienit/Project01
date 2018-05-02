<?php if ($USER_LOGGED) : ?>
    <md-sidenav ng-init="elevation = 3" md-whiteframe="@{{elevation}}" class="md-sidenav-left" md-component-id="left">
        <md-toolbar layout="row">
            <div class="md-toolbar-tools">
                <img src="{{ asset('vendor/' . $group_name . '/' . $skin . '/images/logo.png') }}"/>
                <span flex></span>
                <md-button class="md-icon-button" aria-label="Close Side Panel" ng-click="closeSideNavPanel()">
                    <md-tooltip>Close Side Panel</md-tooltip>
                    <md-icon class="md-default-theme" class="material-icons">cancel</md-icon>
                </md-button>
            </div>
        </md-toolbar>
        <md-content layout-no-padding="">
            <md-list>
                @if ($USER_LOGGED->canAccess('afp.core.dashboard.index'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE871;</md-icon>
                        <p><a href="{{ route("afp.core.dashboard.index") }}">{{ trans('afp-core::sidebar.dashboard') }}</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.site.manage'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xEB3F;</md-icon>
                        <p><a href="{{ route("afp.core.site.manage") }}">{{ trans('afp-core::sidebar.site') }}</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.report.manage'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE6E1;</md-icon>
                        <p><a href="{{ route("afp.core.report.manage") }}">{{ trans('afp-core::sidebar.report') }}</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.payment.manage'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE263;</md-icon>
                        <p><a href="{{ route("afp.core.payment.manage") }}">{{ trans('afp-core::sidebar.payment') }}</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.payment-mail.manage'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE0BE;</md-icon>
                        <p><a href="{{ route("afp.core.payment-mail.manage") }}">Mail thanh toán</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.user-info.list'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE853;</md-icon>
                        <p><a href="{{ route("afp.core.user-info.list") }}">{{ trans('afp-core::sidebar.user-info') }}</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.category.list'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE237;</md-icon>
                        <p><a href="{{ route("afp.core.category.list") }}">{{ trans('afp-core::sidebar.category') }}</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.tag.list'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE892;</md-icon>
                        <p><a href="{{ route("afp.core.tag.list") }}">{{ trans('afp-core::sidebar.tag') }}</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.box-format.list'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE8AA;</md-icon>
                        <p><a href="{{ route("afp.core.box-format.list") }}">{{ trans('afp-core::sidebar.box-format') }}</a></p>
                    </md-list-item>
                @endif
                @if ($USER_LOGGED->canAccess('afp.core.zone-template.list'))
                    <md-list-item>
                        <md-icon class="md-default-theme" class="material-icons">&#xE865;</md-icon>
                        <p><a href="{{ route("afp.core.zone-template.list") }}">{{ trans('afp-core::sidebar.zone-template') }}</a></p>
                    </md-list-item>
                @endif
            </md-list>
        </md-content>
    </md-sidenav>
<?php endif; ?>