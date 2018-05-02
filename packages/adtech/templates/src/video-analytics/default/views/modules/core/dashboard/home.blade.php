@extends('layouts.default')
@section('content')
    <div ng-app="AdtechApp" ng-controller="IndexController">
        <a href="{{ route('adtech.core.auth.login')  }}">{{ __('adtech-core::buttons.login')  }}</a>
    </div>
@stop