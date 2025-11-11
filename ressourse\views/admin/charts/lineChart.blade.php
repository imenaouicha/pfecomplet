<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div id="BarChartContainer" style="width: 900px;"></div>




    <script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    
 Highcharts.chart('BarChartContainer', {

    title: {
        text: 'Nombre de  demandes par mois',
        align: 'left'
    },

    yAxis: {
        min: 0,
        title: {
            text: 'Nombre de demandes'
        }
    },

    xAxis: {
        categories: @json($months),
        title: {
            text: 'Mois'
        }
    },



    series: [{
        name: 'Demandes',
        data: @json($monthlyData)
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
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
