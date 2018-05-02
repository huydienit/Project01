'use strict';
angular
    .module("AdtechApp")
    .controller('reportCtrl', reportCtrl);

function reportCtrl($scope, $mdDialog, $http, $mdToast, removeByAttr) {
    $scope.sortBy = function(tblDate) {
        $scope.reverse = ($scope.tblDate === tblDate) ? !$scope.reverse : false;
        $scope.tblDate = tblDate;
    };
    $scope.sortByZone = function(tblZone) {
        $scope.reverse = ($scope.tblZone === tblZone) ? !$scope.reverse : false;
        $scope.tblZone = tblZone;
    };
}

var chart = Highcharts.chart('container_pc', {
    chart: {
        zoomType: 'xy'
    },
    credits: {
        enabled: false
    },
    title: {
        text: 'Báo cáo hiệu suất'
    },
    subtitle: {
        text: ''
    },
    xAxis: [{
        categories: xData,
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            // format: '{value}',
            formatter: function () {
                return Highcharts.numberFormat(this.value,0);
            },
            style: {
                color: Highcharts.getOptions().colors[2]
            }
        },
        title: {
            text: 'Thanh toán',
            style: {
                color: Highcharts.getOptions().colors[2]
            }
        },
        opposite: true

    }, { // Secondary yAxis
        gridLineWidth: 0,
        title: {
            text: 'Click',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            formatter: function () {
                return Highcharts.numberFormat(this.value,0);
            },
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        }

    }, { // Tertiary yAxis
        gridLineWidth: 0,
        title: {
            text: 'Impression',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        labels: {
            formatter: function () {
                return Highcharts.numberFormat(this.value,0);
            },
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    legend: {
        // layout: 'horizontal',
        // align: 'left',
        // x: 100,
        // verticalAlign: 'top',
        // y: 0,
        // floating: true,
        // backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        align: 'center',
        verticalAlign: 'bottom',
        itemWidth: 100
    },
    series: [{
        name: '.'
    }, {
        name: 'Thanh toán',
        type: 'column',
        color: '#7CB5EC',
        yAxis: 1,
        data: dataMoney,
        tooltip: {
            valueSuffix: ' đ'
        }

    }, {
        name: 'Impression',
        type: 'spline',
        yAxis: 2,
        data: dataImp,
        // marker: {
        //     enabled: false
        // },
        // dashStyle: 'shortdot',
        tooltip: {
            valueSuffix: ' imp'
        }

    }, {
        name: 'Click',
        type: 'spline',
        data: dataClick,
        tooltip: {
            valueSuffix: ' click'
        }
    }]
});
//end chart 1
chart.series[0].hide();
$('#container_pc').highcharts().reflow();
$('#container_pc').highcharts().setSize(
    $(document).width()-68,
    400,
    false
);
$(window).resize(function()
{
    $('#container_pc').highcharts().setSize(
        $(document).width()-68,
        400,
        false
    );
});

$('#container').bind('mousemove touchmove touchstart', function (e) {
    var chart,
        point,
        i,
        event;

    for (i = 0; i < Highcharts.charts.length; i = i + 1) {
        chart = Highcharts.charts[i];
        event = chart.pointer.normalize(e.originalEvent); // Find coordinates within the chart
        point = chart.series[0].searchPoint(event, true); // Get the hovered point

        if (point) {
            point.highlight(e);
        }
    }
});
/**
 * Override the reset function, we don't need to hide the tooltips and crosshairs.
 */
Highcharts.Pointer.prototype.reset = function () {
    return undefined;
};

/**
 * Highlight a point by showing tooltip, setting hover state and draw crosshair
 */
Highcharts.Point.prototype.highlight = function (event) {
    this.onMouseOver(); // Show the hover marker
    this.series.chart.tooltip.refresh(this); // Show the tooltip
    this.series.chart.xAxis[0].drawCrosshair(event, this); // Show the crosshair
};

/**
 * Synchronize zooming through the setExtremes event handler.
 */
function syncExtremes(e) {
    var thisChart = this.chart;

    if (e.trigger !== 'syncExtremes') { // Prevent feedback loop
        Highcharts.each(Highcharts.charts, function (chart) {
            if (chart !== thisChart) {
                if (chart.xAxis[0].setExtremes) { // It is null while updating
                    chart.xAxis[0].setExtremes(e.min, e.max, undefined, false, { trigger: 'syncExtremes' });
                }
            }
        });
    }
}

// Get the data. The contents of the data file can be viewed at
// https://github.com/highcharts/highcharts/blob/master/samples/data/activity.json
// $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=activity.json&callback=?', function (activity) {
var activity = charData;
$.each(activity.datasets, function (i, dataset) {

    // Add X values
    dataset.data = Highcharts.map(dataset.data, function (val, j) {
        return [activity.xData[j], val];
    });

    $('<div class="chart">')
        .appendTo('#container')
        .highcharts({
            chart: {
                marginLeft: 40, // Keep all charts left aligned
                spacingTop: 20,
                spacingBottom: 20
            },
            title: {
                text: dataset.name,
                align: 'left',
                margin: 0,
                x: 30
            },
            credits: {
                enabled: false
            },
            legend: {
                enabled: false
            },
            xAxis: {
                categories: activity.xData,
                crosshair: true,
                events: {
                    setExtremes: syncExtremes
                },
            },
            yAxis: {
                title: {
                    text: null
                }
            },
            tooltip: {
                positioner: function () {
                    return {
                        x: this.chart.chartWidth - this.label.width, // right aligned
                        y: 10 // align to title
                    };
                },
                borderWidth: 0,
                backgroundColor: 'none',
                pointFormat: '{point.y}',
                headerFormat: '',
                shadow: false,
                style: {
                    fontSize: '18px'
                },
                valueDecimals: dataset.valueDecimals
            },
            series: [{
                data: dataset.data,
                name: dataset.name,
                type: dataset.type,
                color: Highcharts.getOptions().colors[i],
                fillOpacity: 0.3,
                tooltip: {
                    valueSuffix: ' ' + dataset.unit
                }
            }]
        });
});
// });