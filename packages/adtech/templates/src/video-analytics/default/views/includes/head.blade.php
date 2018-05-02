<meta charset="utf-8">
<title>@yield('title') - {{ config('app.name') }}</title>
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}"/>

@section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic"/>
    <link rel="stylesheet"
          href="{{ asset('vendor/adtech-cms-material/default/css/latest/angular-material.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/adtech-cms-material/default/css/latest/docs.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/adtech-cms-material/default/css/adtech.app.css') }}"/>
@stop

@push('scripts-footer')
<script type="text/javascript">
    var AdtechApp = {
        extra: [],
        @if (isset($USER_LOGGED_EMAIL) && isset($USER_LOGGED) && $USER_LOGGED)
        menu: {
            email: "{!! trans('adtech-core::labels.hello', ['email' => $USER_LOGGED->first_name]) !!}",
            'settings': {
                name: "Settings",
                items: [
                    {
                        name: "{{ trans('adtech-core::buttons.account') }}",
                        link: "{{ route('adtech.core.dashboard.index') }}"
                    },
                    {name: "{{ trans('adtech-core::buttons.logout') }}", link: "{{ route('adtech.core.auth.logout') }}"}
                ]
            }
        }
        @endif
    };
</script>
<script src="{{ asset('vendor/adtech-cms-material/default/js/preload.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-route.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/svg-assets-cache.js"></script>
<script src="https://cdn.gitcdn.link/cdn/angular/bower-material/v1.1.3/angular-material.js"></script>
<script src="{{ asset('vendor/adtech-cms-material/default/js/docs.js?t=' . time()) }}"></script>
@endpush