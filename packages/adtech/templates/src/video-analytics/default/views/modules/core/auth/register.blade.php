@extends('layouts.login')
@section('title', __('adtech-core::titles.page.register'))
@section('content')
    <div layout="column" layout-align="center center" class="container-login">
        <div class="logo">
            <img src="https://analytics.admicro.vn/static/themes/none-responsive/images/logo.png"/>
        </div>
        <div class="message">
            <h2>{{ __('adtech-core::labels.login_one_account') }}</h2>
        </div>
        <form class="adtech-form" action="" method="post" name="loginForm" ng-submit="submitForm()">
            {{ csrf_field() }}
            <div ng-init="elevation = 5" md-whiteframe="@{{elevation}}" class="form-login">
                <md-toolbar>
                    <h2 class="md-toolbar-tools"><span>{{ __('adtech-core::labels.create_new_account') }}</span></h2>
                </md-toolbar>
                <md-content class="md-padding md-no-momentum">
                    <md-input-container class="md-block md-input-invalid">
                        <!-- Use floating placeholder instead of label -->
                        <md-icon aria-label="email" class="material-icons md-24">email</md-icon>
                        <input ng-model="user.email" type="email" name="email"
                               placeholder="{{ __('adtech-core::labels.email_address') }}" ng-required="true">
                        <div ng-messages="loginForm.email.$error" role="alert">
                            @if ($errors->has('email'))
                                <div ng-message="required" style="opacity: 1; margin-top: 0;">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <div ng-message="required">
                                {{ __('adtech-core::messages.email_required') }}
                            </div>
                            <div ng-message="email">
                                {{ __('adtech-core::messages.email_invalid') }}
                            </div>
                        </div>
                    </md-input-container>
                    <md-input-container class="md-block">
                        <!-- Use floating placeholder instead of label -->
                        <md-icon aria-label="lock" class="material-icons md-24">lock</md-icon>
                        <input ng-model="user.password" type="password" id="input-password" name="password"
                               placeholder="{{ __('adtech-core::labels.password') }}" ng-required="true"
                               md-minlength="6" md-maxlength="30"/>
                        <div ng-messages="loginForm.password.$error" role="alert">
                            @if ($errors->has('password'))
                                <div ng-message="password" style="opacity: 1; margin-top: 0;">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <div ng-message="required">
                                {{ __('adtech-core::messages.password_required') }}
                            </div>
                            <div ng-message="md-minlength">
                                {{ __('adtech-core::messages.password_min') }}
                            </div>
                            <div ng-message="md-maxlength">
                                {{ __('adtech-core::messages.password_max') }}
                            </div>
                        </div>
                    </md-input-container>
                    <md-input-container class="md-block">
                        <!-- Use floating placeholder instead of label -->
                        <md-icon aria-label="lock" class="material-icons md-24">lock</md-icon>
                        <input ng-model="user.confirm_password" type="password" id="input-confirm-password"
                               name="confirmPassword" placeholder="{{ __('adtech-core::labels.confirm_new_password') }}"
                               ng-required="true" md-minlength="6" md-maxlength="30"/>
                        <div ng-messages="loginForm.confirmPassword.$error" role="alert">
                            @if ($errors->has('confirmPassword'))
                                <div ng-message="confirmPassword" style="opacity: 1; margin-top: 0;">
                                    {{ $errors->first('confirmPassword') }}
                                </div>
                            @endif
                            <div ng-message="required">
                                {{ __('adtech-core::messages.password_required') }}
                            </div>
                            <div ng-message="md-minlength">
                                {{ __('adtech-core::messages.password_min') }}
                            </div>
                            <div ng-message="md-maxlength">
                                {{ __('adtech-core::messages.password_max') }}
                            </div>
                        </div>
                    </md-input-container>
                    <md-input-container class="md-block">
                        <div class="g-recaptcha" data-sitekey="{{ config('site.google_recaptcha.site_key') }}"></div>
                    </md-input-container>
                    <div layout="row" layout-align="center center">
                        <md-button class="adtech-click-loading" href="{{ route('adtech.core.auth.login') }}"
                                   md-no-ink="md-no-ink">{{ __('adtech-core::buttons.login') }}</md-button>
                        <div flex="flex"></div>
                        <md-button type="submit"
                                   class="md-raised md-primary">{{ __('adtech-core::buttons.create') }}</md-button>
                    </div>
                </md-content>
            </div>
        </form>
    </div>
@stop
@push('scripts-footer')
<script src="https://www.google.com/recaptcha/api.js"></script>
@endpush