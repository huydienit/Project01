<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
    <header class="demo-drawer-header">
        <a href="{{ route('core.dashboard.index') }}"><img
                    src="/vendor/{{ $APP_GROUP_NAME }}/{{ $APP_SKIN }}/images/logo-mini.png" class="demo-avatar"/></a>
        <div class="demo-avatar-dropdown">
            <span>Hello, Guest</span>
            <div class="mdl-layout-spacer"></div>
        </div>
    </header>
    @include('includes.sidebar')
</div>