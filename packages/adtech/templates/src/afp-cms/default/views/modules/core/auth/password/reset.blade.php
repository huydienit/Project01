@extends('layouts.login')
@section('title', __('afp-core::titles.page.reset_password'))
@section('content')
    <div layout="column" layout-align="center center" class="container-login">
        <div class="logo">
            <img src="https://analytics.admicro.vn/static/themes/none-responsive/images/logo.png"/>
        </div>
        <div class="message">
            <h2>{{ __('afp-core::labels.setting_new_password') }}</h2>
        </div>
        <form action="" method="post" name="loginForm">
            {{ csrf_field() }}
            <div ng-init="elevation = 5" md-whiteframe="@{{elevation}}" class="form-login" ng-submit="submitForm()">
                <md-content class="md-padding" layout="column">
                    <label>{{ __('afp-core::labels.new_password') }}</label>
                    <md-input-container>
                        <input type="password" name="inputPassword" md-autofocus/>
                    </md-input-container>
                    <label>{{ __('afp-core::labels.confirm_new_password') }}</label>
                    <md-input-container>
                        <input type="password" name="inputConfirmPassword"/>
                    </md-input-container>
                    <div layout="row" layout-align="center center">
                        <md-button class="adtech-click-loading" href="{{ route('adtech.core.auth.login') }}"
                                   md-no-ink="md-no-ink">{{ __('afp-core::buttons.login') }}</md-button>
                        <div flex="flex"></div>
                        <md-button type="submit"
                                   class="md-raised md-primary adtech-click-loading">{{ __('afp-core::buttons.change_password') }}</md-button>
                    </div>
                </md-content>
            </div>
        </form>
    </div>
@stop
