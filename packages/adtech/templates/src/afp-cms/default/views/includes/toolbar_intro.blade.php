<md-toolbar class="desktop header">
    <div class="md-toolbar-tools" ng-init="elevation = 3" md-whiteframe="@{{elevation}}">
        <img src="{{ asset('vendor/' . $group_name . '/' . $skin . '/images/logo.png') }}"/>
        <span flex></span>
    </div>
</md-toolbar>
<md-toolbar class="tablet header">
    <div class="md-toolbar-tools" ng-init="elevation = 3" md-whiteframe="@{{elevation}}">
        <img src="{{ asset('vendor/' . $group_name . '/' . $skin . '/images/logo.png') }}"/>
        <span flex></span>
    </div>
</md-toolbar>
<md-toolbar class="mobile header">
    <div class="md-toolbar-tools" ng-init="elevation = 3" md-whiteframe="@{{elevation}}"
         data-ng-show="showMobileMainHeader">
        <img src="{{ asset('vendor/' . $group_name . '/' . $skin . '/images/logo.png') }}"/>
        <span flex></span>
    </div>
</md-toolbar>

<script type="text/ng-template" id="panel.tmpl.html">
    <div role="dialog" aria-label="Eat me!" layout="column" layout-align="center center">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>Surprise!</h2>
            </div>
        </md-toolbar>

        <div class="demo-dialog-content">
            <p>
                You hit the secret button. Here's a donut:
            </p>

            <div layout="row">
                <img flex alt="Delicious donut" src="img/donut.jpg">
            </div>
        </div>

        <div layout="row" class="demo-dialog-button">
            <md-button md-autofocus flex class="md-primary" ng-click="closeDialog()">
                Close
            </md-button>
        </div>
    </div>
</script>