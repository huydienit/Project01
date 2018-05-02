@extends('layouts.login')
@section('title', __('afp-core::titles.page.login'))
@section('content')
    <div layout="column" layout-align="center center" class="container-login">
        <div class="logo">
            <img src="https://analytics.admicro.vn/static/themes/none-responsive/images/logo.png"/>
        </div>
        <div class="message">
            <h2>{{ __('afp-core::labels.login_one_account') }}</h2>
            <h4>{{ __('afp-core::labels.login_sign_in') }}</h4>
        </div>
        <form class="adtech-form" action="" method="post" name="loginForm" ng-submit="submitForm()">
            {{ csrf_field() }}
            <div ng-init="elevation = 5" md-whiteframe="@{{elevation}}" class="form-login">
                <md-toolbar>
                    <h2 class="md-toolbar-tools"><span>{{ __('afp-core::labels.login') }}</span></h2>
                </md-toolbar>
                <md-content class="md-padding md-no-momentum">
                    <md-input-container class="md-block">
                        <!-- Use floating placeholder instead of label -->
                        <md-icon aria-label="email" class="material-icons md-24">email</md-icon>
                        <input ng-model="user.email" type="email" name="inputEmail"
                               placeholder="{{ __('afp-core::labels.email_address') }}" ng-required="true">
                    </md-input-container>
                    <md-input-container class="md-block">
                        <!-- Use floating placeholder instead of label -->
                        <md-icon aria-label="lock" class="material-icons md-24">lock</md-icon>
                        <input ng-model="user.password" type="password" name="inputPassword"
                               placeholder="{{ __('afp-core::labels.password') }}" ng-required="true">
                    </md-input-container>

                    <div layout="row" layout-align="center center">
                        <md-button class="adtech-click-loading" href="{{ route('adtech.core.auth.forgot') }}"
                                   md-no-ink="md-no-ink">{{ __('afp-core::buttons.forgot_password') }}</md-button>
                        <div flex="flex"></div>
                        <md-button type="submit"
                                   class="md-raised md-primary">{{ __('afp-core::buttons.login') }}</md-button>
                    </div>
                </md-content>
            </div>
            <div class="message">
                <md-input-container>
                    <md-button class="md-accent adtech-click-loading" href="{{ route('adtech.core.auth.register') }}"
                               md-no-ink="md-no-ink">{{ __('afp-core::buttons.create_account') }}</md-button>
                </md-input-container>
            </div>
        </form>
    </div>
@stop
