<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   
    <div id="barChartContainer" style="width: 100%; height: 400px;">

    </div>




    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        
    Highcharts.chart('barChartContainer', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'les Formations Les Plus Demandées'
        },
       
        xAxis: {
    categories: {!! json_encode($categoriesChart, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) !!},
    crosshair: true,
    accessibility: {
        description: 'Formations'
    }
},
        yAxis: {
            min: 0,
            title: {
                text: 'Nombre de demandes'
            }
        },
       
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Demandes',
           data: @json($data) ,
           color: '#769ebd'
        
        }]
    });
    </script>
</body>
</html>

