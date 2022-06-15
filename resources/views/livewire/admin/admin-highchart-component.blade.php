<x-layout>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var datas = <?php echo json_encode($datas); ?>;
        Highcharts.chart('chart-container', {
            title: {
                text: 'New Users Growth, 2022'
            },
            subtitle: {
                text: 'Source: njust-campus-canteen'
            },
            xAxis: {
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ]
            },
            yAxis: {
                title: {
                    text: 'Number of New Users'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New Users',
                data: datas
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

</x-layout>
