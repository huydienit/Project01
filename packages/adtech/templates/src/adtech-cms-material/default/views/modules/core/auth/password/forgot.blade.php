@extends('layouts.login')
@section('title', __('adtech-core::titles.page.forgot_password'))
@section('content')
    <div layout="column" layout-align="center center" class="container-login">
        <div class="logo">
            <img src="https://analytics.admicro.vn/static/themes/none-responsive/images/logo.png"/>
        </div>
        <div class="message">
            <h2>{{ __('adtech-core::labels.forgot_having_trouble') }}</h2>
            <h4>{{ __('adtech-core::labels.forgot_provide_information') }}</h4>
        </div>
        <form class="adtech-form" action="" method="post" id="forgot-form" name="forgotForm" ng-submit="submitForm()">
            {{ csrf_field() }}
            <div ng-init="elevation = 5" md-whiteframe="@{{elevation}}" class="form-login">
                <md-content class="md-padding md-no-momentum">
                    <md-input-container class="md-block">
                        <!-- Use floating placeholder instead of label -->
                        <md-icon aria-label="email" class="material-icons md-24">email</md-icon>
                        <input ng-model="user.email" type="email" id="input-email" name="inputEmail"
                               placeholder="{{ __('adtech-core::labels.email_address') }}" ng-required="true">
                    </md-input-container>
                    <div layout="row" layout-align="center center">
                        <md-button class="adtech-click-loading" href="{{ route('adtech.core.auth.login') }}"
                                   md-no-ink="md-no-ink">{{ __('adtech-core::buttons.login') }}</md-button>
                        <div flex="flex"></div>
                        <md-button type="submit"
                                   class="md-raised md-primary">{{ __('adtech-core::buttons.reset_password') }}</md-button>
                    </div>
                </md-content>
            </div>
        </form>
    </div>
@stop
