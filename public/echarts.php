<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="/js/echarts.common.min.js"></script>
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 600px;height:400px;"></div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '一周订单数量统计'
        },
        tooltip: {},
        legend: {
            data:['订单量']
        },
        xAxis: {
            data: ["01-01","01-02","01-03","01-04","01-05","01-06"]
        },
        yAxis: {},
        series: [{
            name: '订单量',
            type: 'line',
            data: [12, 33, 45, 110, 85, 46]
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>
</html>