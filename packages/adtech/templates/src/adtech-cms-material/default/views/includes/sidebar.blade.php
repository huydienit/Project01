<md-sidenav ng-init="elevation = 3" md-whiteframe="@{{elevation}}" class="md-sidenav-left" md-component-id="left">
    <md-toolbar layout="row">
        <div class="md-toolbar-tools">
            <img src="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/images/logo.png') }}"/>
            <span flex></span>
            <md-button class="md-icon-button" aria-label="Close Side Panel" ng-click="closeSideNavPanel()">
                <md-tooltip>Close Side Panel</md-tooltip>
                <md-icon class="md-default-theme" class="material-icons">cancel</md-icon>
            </md-button>
        </div>
    </md-toolbar>
    <md-content layout-no-padding="">
        <md-list>
            <md-list-item>
                <md-icon class="md-default-theme" class="material-icons">&#xE871;</md-icon>
                <p><a href="{{ route("adtech.core.dashboard.home") }}">Dashboard</a></p>
            </md-list-item>
            <md-subheader class="md-no-sticky">Favorites</md-subheader>
            <md-list-item>
                <md-icon class="md-default-theme" class="material-icons">&#xE0C9;</md-icon>
                <p>Messages</p>
                <div class="md-secondary">2</div>
            </md-list-item>
            <md-list-item>
                <md-icon class="md-default-theme" class="material-icons">&#xE878;</md-icon>
                <p>Events</p>
                <md-icon class="md-secondary">2</md-icon>
            </md-list-item>
            <md-list-item>
                <md-icon class="md-default-theme" class="material-icons">&#xE251;</md-icon>
                <p>Photos</p>
                <md-icon class="md-secondary">2</md-icon>
            </md-list-item>
            <md-divider></md-divider>
            <md-subheader class="md-no-sticky">Pages</md-subheader>
            <md-list-item>
                <md-icon class="md-default-theme" class="material-icons">&#xE7F9;</md-icon>
                <p>Pages Feed</p>
                <div class="md-secondary">2</div>
            </md-list-item>
            <md-list-item>
                <md-icon class="md-default-theme" class="material-icons">&#xE1BC;</md-icon>
                <p>Like Pages</p>
                <div class="md-secondary">20+</div>
            </md-list-item>
        </md-list>
    </md-content>
</md-sidenav>