
<div class="box box-danger">
	<div class="box-header with-border">
		<h3 class="box-title">{{$config['header']}}</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		<canvas id="pieChart{{$config['id']}}" style="height:250px"></canvas>
	</div>
</div>
    
@if($config['id']==1)
@push('js-scripts')
<script src="{{url('bower_components/chart.js/Chart.js')}}"></script>
@endpush
@endif
@push('js-scripts')
<script type="text/javascript">
 $(function () {

    var pieChartCanvas = $('#pieChart{{$config['id']}}').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : 12,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Men'
      },
      {
        value    : 123,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Women'
      }
    ]
    var pieOptions     = {
      segmentShowStroke    : true,
      segmentStrokeColor   : '#fff',
      segmentStrokeWidth   : 2,
      percentageInnerCutout: 50, // This is 0 for Pie charts
      animationSteps       : 100,
      animationEasing      : 'easeOutBounce',
      animateRotate        : true,
      animateScale         : false,
      responsive           : true,
      maintainAspectRatio  : true,
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    pieChart.Doughnut(PieData, pieOptions);
  })
</script>
@endpush