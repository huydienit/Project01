<meta charset="utf-8">
<title>@yield('title') - {{ config('app.name') }}</title>
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}"/>

@section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic"/>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/public/angular-material.css?t=').time() }}"></link>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/public/md-data-table.min.css?t=').time() }}"></link>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/latest/docs.css?t=' . time()) }}"/>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/adtech.app.css?t=' . time()) }}"/>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/app.css?t=' . time()) }}"/>
    {{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css"/>--}}
@stop

@push('scripts-footer')
<script type="text/javascript">
    var AdtechApp = {
        extra: [],
        @if (isset($USER_LOGGED_EMAIL) && isset($USER_LOGGED) && $USER_LOGGED)
        admin_prefix: '{{ config('site.admin_prefix') }}',
        menu: {
            email: "{!! trans('afp-core::labels.hello', ['email' => $USER_LOGGED->username]) !!}",
            user: [
                {name: "Hello, {{ $USER_LOGGED->username }}", link: "javascript: void(0);"},
                {name: "{{ trans('afp-core::buttons.account') }}", link: "{{ route('afp.core.dashboard.index') }}"},
                {name: "{{ trans('afp-core::buttons.logout') }}", link: "{{ route('adtech.core.auth.logout') }}"}
            ]
        }
        @endif
    };
</script>

<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/jquery.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/angular.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/preload.js') }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/angular-sanitize.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/angular-animate.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/angular-ui-router.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/angular-aria.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/angular-messages.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/svg-assets-cache.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/angular-material.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/underscore-min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/lodash.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/angular-material-icons.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/md-data-table.min.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/public/highcharts.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/adtech.app.js?t=' . time()) }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/config.js?t=').time() }}"></script>
<script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/services.js?t=').time() }}"></script>
@endpush