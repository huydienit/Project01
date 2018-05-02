<md-toolbar class="desktop header">
    <div class="md-toolbar-tools" ng-init="elevation = 3" md-whiteframe="@{{elevation}}">
        <md-button class="md-icon-button" aria-label="Side Panel" ng-click="openSideNavPanel()">
            <md-tooltip>Side Panel</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">reorder</md-icon>
        </md-button>
        <img src="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/images/logo.png') }}"/>
        <span flex></span>
        <md-button class="md-icon-button settings-user" aria-label="User"
                   ng-click="rootCtrl.showMenu($event, '.settings-user', menu.user)">
            <md-tooltip>User</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">record_voice_over</md-icon>
        </md-button>
        <md-button class="md-icon-button" aria-label="Messages">
            <md-tooltip>Messages</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">add_alert</md-icon>
        </md-button>
        <md-button class="md-icon-button settings-menu" aria-label="Settings"
                   ng-click="rootCtrl.showMenu($event, '.settings-menu', menu.settings)">
            <md-tooltip>Settings</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
        </md-button>
    </div>
</md-toolbar>
<md-toolbar class="tablet header">
    <div class="md-toolbar-tools" ng-init="elevation = 3" md-whiteframe="@{{elevation}}">
        <md-button class="md-icon-button" aria-label="Side Panel" ng-click="openSideNavPanel()">
            <md-tooltip>Open Side Panel</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">reorder</md-icon>
        </md-button>
        <img src="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/images/logo.png') }}"/>
        <span flex></span>
        <md-button class="md-icon-button" aria-label="User">
            <md-tooltip>User</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">record_voice_over</md-icon>
        </md-button>
        <md-button class="md-icon-button" aria-label="Messages">
            <md-tooltip>Messages</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">add_alert</md-icon>
        </md-button>
        <md-button class="md-icon-button settings-menu" aria-label="Settings" ng-click="rootCtrl.showMenu($event)">
            <md-tooltip>Settings</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
        </md-button>
    </div>
</md-toolbar>
<md-toolbar class="mobile header">
    <div class="md-toolbar-tools" ng-init="elevation = 3" md-whiteframe="@{{elevation}}"
         data-ng-show="showMobileMainHeader">
        <md-button class="md-icon-button" aria-label="Side Panel" ng-click="openSideNavPanel()">
            <md-tooltip>Open Side Panel</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">reorder</md-icon>
        </md-button>
        <img src="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/images/logo.png') }}"/>
        <span flex></span>
        <md-button class="md-icon-button" aria-label="User">
            <md-tooltip>User</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">record_voice_over</md-icon>
        </md-button>
        <md-button class="md-icon-button" aria-label="Messages">
            <md-tooltip>Messages</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">add_alert</md-icon>
        </md-button>
        <md-button class="md-icon-button settings-menu" aria-label="Settings" ng-click="rootCtrl.showMenu($event)">
            <md-tooltip>Settings</md-tooltip>
            <md-icon class="md-default-theme" class="material-icons">settings</md-icon>
        </md-button>
    </div>
    <div class="md-toolbar-tools" data-ng-hide="showMobileMainHeader">
        <md-button class="md-icon-button" aria-label="Back" data-ng-click="showMobileMainHeader = true">
            <md-tooltip>Back</md-tooltip>
            <md-icon class="material-icons">&#xE5C4;</md-icon>
        </md-button>
        <md-input-container md-no-float class="md-accent" style="padding-bottom:0px;">
            <input ng-model="searchInput" placeholder="Search here" style="color:wheat;">
        </md-input-container>
        <span flex></span>
        <md-button class="md-icon-button" aria-label="Search">
            <md-tooltip>Search</md-tooltip>
            <md-icon class="material-icons">&#xE163;</md-icon>
        </md-button>
    </div>
</md-toolbar>

<script type="text/ng-template" id="panel.tmpl.html">
    <div role="dialog" aria-label="Eat me!" layout="column" layout-align="center center">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>Surprise!</h2>
            </div>
        </md-toolbar>

        <div class="demo-dialog-content">
            <p>
                You hit the secret button. Here's a donut:
            </p>

            <div layout="row">
                <img flex alt="Delicious donut" src="img/donut.jpg">
            </div>
        </div>

        <div layout="row" class="demo-dialog-button">
            <md-button md-autofocus flex class="md-primary" ng-click="closeDialog()">
                Close
            </md-button>
        </div>
    </div>
</script>