@extends('layouts.default')
@section('content')
    @if ($USER_LOGGED_EMAIL)
        <a adtech-click-loading href="{{ route('adtech.core.auth.logout') }}">{{ $USER_LOGGED_EMAIL  }}</a>
        <a adtech-click-loading
           href="{{ route('adtech.core.auth.logout') }}">{{ __('adtech-core::buttons.logout')  }}</a>
    @else
        <a adtech-click-loading
           href="{{ route('adtech.core.auth.login')  }}">{{ __('adtech-core::buttons.login')  }}</a>
    @endif
@stop
