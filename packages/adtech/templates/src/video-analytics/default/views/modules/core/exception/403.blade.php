@section('title', 'OOPS! - Access denied')
@section('content')
    <div layout="column" layout-align="center center" class="container-login">
        <h1>OOPS! - Access denied</h1>
        <img src="{{ asset('vendor/adtech-cms-material/default/images/404.png') }}"/>
        <div class="message">
            <md-input-container>
                <md-button class="md-raised md-primary" href="{{ route('adtech.core.dashboard.index') }}"
                           md-no-ink="md-no-ink">{{ __('adtech-core::buttons.back') }}</md-button>
            </md-input-container>
        </div>
    </div>
@stop