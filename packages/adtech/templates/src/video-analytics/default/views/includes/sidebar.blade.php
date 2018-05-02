<md-sidenav class="site-sidenav md-sidenav-left md-whiteframe-z2"
            md-component-id="sidenav-left" hide-print
            md-is-locked-open="$mdMedia('gt-sm')">
    <header class="nav-header">
        <a ng-href="{{ route('adtech.core.dashboard.index') }}" class="docs-logo">
            <img src="https://material.angularjs.org/latest/img/icons/angular-logo.svg" alt=""/>
            <h1 class="docs-logotype md-heading">{{ config('app.name') }}</h1>
        </a>
    </header>

    <ul class="skip-links">
        <li class="md-whiteframe-z2">
            <md-button ng-click="focusMainContent($event)" href="#">Skip to content</md-button>
        </li>
    </ul>

    <md-content flex role="navigation">
        <ul class="docs-menu">
            <li ng-repeat="section in menu.sections" class="parent-list-item @{{section.className || ''}}"
                ng-class="{'parentActive' : isSectionSelected(section)}">
                <h2 class="menu-heading md-subhead" ng-if="section.type === 'heading'"
                    id="heading_@{{ section.name | nospace }}">
                    @{{section.name}}
                </h2>
                <menu-link section="section" ng-if="section.type === 'link' && !section.hidden"></menu-link>

                <menu-toggle section="section" ng-if="section.type === 'toggle' && !section.hidden"></menu-toggle>

                <ul ng-if="section.children" class="menu-nested-list">
                    <li ng-repeat="child in section.children" ng-class="{'childActive' : isSectionSelected(child)}">
                        <menu-link section="child" ng-if="child.type === 'link'"></menu-link>

                        <menu-toggle section="child" ng-if="child.type === 'toggle'"></menu-toggle>
                    </li>
                </ul>
            </li>
        </ul>
    </md-content>
</md-sidenav>