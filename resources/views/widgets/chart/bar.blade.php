<!-- BAR CHART -->
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">{{$config['header']}}</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="chart">
      <canvas id="barChart{{$config['id']}}" style="height:230px"></canvas>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
    
@if($config['id']==1)
@push('js-scripts')
<script src="{{url('bower_components/chart.js/Chart.js')}}"></script>
@endpush
@endif
@push('js-scripts')
<script type="text/javascript">
 $(function () {
    var areaChartData = {
      labels  : <?=$config['labels']?>,
      // labels : ['January', 'February', 'March', 'April'],
      datasets: [
        {
          label               : '',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : {{$config['data']}}
        },
      ]
    }





    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart{{$config['id']}}').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    // barChartData.datasets[0].fillColor   = '#00a65a'
    barChartData.datasets[0].fillColor   = '#4f5bc2'
    // barChartData.datasets[2].fillColor   = '#2ee5d8'
    // barChartData.datasets[3].fillColor   = '#ace52e'
    // barChartData.datasets[0].strokeColor = '#00a65a'
    // barChartData.datasets[0].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>
@endpush