<meta charset="utf-8">
<title>@yield('title') - {{ config('app.name') }}</title>
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}"/>

@section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic"/>
    {{--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.1/angular-material.min.css" />--}}
    <link rel="stylesheet" href="http://cdn.rawgit.com/angular/bower-material/v1.1.4/angular-material.css"/>
    <link rel="stylesheet" href="http://danielnagy.me/md-data-table/dependencies/md-data-table.min.css"/>
    <link rel="stylesheet"
          href="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/css/latest/docs.css?t=' . time()) }}"/>
    <link rel="stylesheet"
          href="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/css/adtech.app.css?t=' . time()) }}"/>
    <link rel="stylesheet"
          href="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/css/app.css?t=' . time()) }}"/>
@stop

@push('scripts-footer')
<script type="text/javascript">
    var AdtechApp = {
        extra: [],
        @if (isset($USER_LOGGED_EMAIL) && isset($USER_LOGGED) && $USER_LOGGED)
        admin_prefix: '{{ config('site.admin_prefix') }}',
        menu: {
            email: "{!! trans('adtech-core::labels.hello', ['email' => $USER_LOGGED->username]) !!}",
            user: [
                {name: "Hello, {{ $USER_LOGGED->username }}", link: "javascript: void(0);"},
                {
                    name: "{{ trans('adtech-core::buttons.account') }}",
                    link: "{{ route('adtech.core.dashboard.index') }}"
                },
                {name: "{{ trans('adtech-core::buttons.logout') }}", link: "{{ route('adtech.core.auth.logout') }}"}
            ]
        }
        @endif
    };
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/js/preload.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-sanitize.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-animate.min.js"></script>
<script src="https://unpkg.com/angular-ui-router/release/angular-ui-router.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-messages.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/svg-assets-cache.js"></script>
<script src="https://cdn.gitcdn.link/cdn/angular/bower-material/v1.1.4/angular-material.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>
<script src="https://cdn.jsdelivr.net/angular-material-icons/0.6.0/angular-material-icons.min.js"></script>
<script src="http://danielnagy.me/md-data-table/dependencies/md-data-table.min.js"></script>

{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular-sanitize.js"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular-animate.min.js"></script>--}}
{{--<script src="https://unpkg.com/angular-ui-router/release/angular-ui-router.min.js"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular-aria.min.js"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular-messages.min.js"></script>--}}
{{--<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/svg-assets-cache.js"></script>--}}
{{--<script src="https://cdn.gitcdn.link/cdn/angular/bower-material/v1.1.3/angular-material.js"></script>--}}

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>--}}

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/md-data-table/1.8.0/md-data-table-templates.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/md-data-table/1.8.0/md-data-table.min.js"></script>--}}

<script src="{{ asset('vendor/' . config('site.group_name') . '/' . config('site.desktop.skin') . '/js/adtech.app.js?t=' . time()) }}"></script>
@endpush