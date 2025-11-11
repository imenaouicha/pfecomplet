<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #pieChartcontainer {
            width: 100%; 
            height: 400px;
            margin: 0 auto;
            background: transparent;
        }
        .highcharts-credits {
            display: none !important;
        }
    </style>
</head>
<body>
    <div id="pieChartcontainer"></div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        
        Highcharts.chart('pieChartcontainer', {
            chart: {
                type: 'pie',
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce'
                },
                backgroundColor: 'transparent',
                plotShadow: true,
                shadow: {
                    color: '#000',
                    offsetX: 0,
                    offsetY: 0,
                    opacity: 0.1,
                    width: 5
                }
            },
            title: {
                text: 'Taux de formation des employés',
                style: {
                    color: '#333',
                    fontSize: '18px',
                    fontWeight: 'bold'
                }
            },
            tooltip: {
                pointFormat: '<span style="color:{point.color}">●</span> {point.name}: <b>{point.y:.1f}%</b>',
                style: {
                    fontSize: '14px'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    borderWidth: 0,
                    innerSize: '30%',
                    showInLegend: true,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y:.1f}%',
                        distance: 15,
                        style: {
                            color: '#333',
                            fontSize: '12px',
                            fontWeight: 'normal',
                            textOutline: 'none'
                        },
                        connectorColor: '#666',
                        connectorWidth: 1
                    },
                    startAngle: 0,
                    endAngle: 360,
                    center: ['50%', '50%'],
                    size: '100%',
                    states: {
                        hover: {
                            brightness: 0.1,
                            halo: {
                                size: 10,
                                opacity: 0.25
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'Employés',
                colorByPoint: true,
                data: [
                    { 
                        name: 'Sans formation', 
                        y: {{$pieData[0]['y']}}, 
                        color: '#443371',
                        sliced: true,
                        selected: false
                    },
                    { 
                        name: 'Non satisfaits', 
                        y: {{$pieData[1]['y']}}, 
                        color: '#6A5ACD' 
                    },
                    { 
                        name: 'Satisfaits', 
                        y: {{$pieData[2]['y']}}, 
                        color: '#87CEFA',
                        sliced: true
                    }
                ],
                point: {
                    events: {
                        mouseOver: function() {
                            this.slice();
                        },
                        mouseOut: function() {
                            if (!this.selected) {
                                this.slice(false);
                            }
                        }
                    }
                }
            }],
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom',
                itemStyle: {
                    fontSize: '12px',
                    fontWeight: 'normal'
                },
                symbolRadius: 0
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    enabled: false
                                }
                            }
                        },
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
</body>
</html>
