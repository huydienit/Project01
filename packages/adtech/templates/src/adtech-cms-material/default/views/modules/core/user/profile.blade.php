@extends('layouts.default')
@section('content')
    <div ng-controller="UserController">
        <form name="userForm" ng-submit="submit()">
            <input type="hidden" ng-model="user.id">
            <md-input-container class="md-block">
                <label>First Name</label>
                <input name="first_name" ng-model="user.first_name" required>
                <div ng-messages="userForm.first_name.$error" ng-show="userForm.first_name.$dirty">
                    <div ng-message="required">This is required!</div>
                </div>
            </md-input-container>
            <md-input-container class="md-block">
                <label>Last Name</label>
                <input name="last_name" ng-model="user.last_name" required>
                <div ng-messages="userForm.last_name.$error" ng-show="userForm.last_name.$dirty">
                    <div ng-message="required">This is required!</div>
                </div>
            </md-input-container>
            <md-input-container class="md-block">
                <label>Email</label>
                <input type="email" name="email" ng-model="user.email" required>
                <div ng-messages="userForm.email.$error" ng-show="userForm.email.$dirty">
                    <div ng-message="required">This is required!</div>
                    <div ng-message="email">This is email!</div>
                </div>
            </md-input-container>
            <md-input-container class="md-block">
                <md-button type="submit" class="md-raised md-primary" ng-disabled="userForm.$invalid">Save</md-button>
            </md-input-container>
        </form>
    </div>
@stop
@push('scripts-footer-bottom')
<script src="{{ asset('vendor/adtech-cms-material/default/js/services.js?t=' . time()) }}"></script>
<script src="{{ asset('vendor/adtech-cms-material/default/js/user.js?t=' . time()) }}"></script>
@endpush