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
    <div id="barChart{{$config['id']}}" >
      <!-- <canvas  style="height:230px"></canvas> -->
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
    
@if($config['id']==1)
@push('css-scripts')
<script type="text/javascript" src="{{url('js/plotly.min.js')}}"></script>
@endpush
@endif

@push('js-scripts')
<script type="text/javascript">
  var data = [{
    x: <?=$config['labels']?>,
    y: {{$config['data']}},
    marker:{
      color: ['rgb(219, 219, 15)', 'rgb(59, 230, 59)', 'rgb(52, 52, 197)', 'rgba(204,204,204,1)', 'rgb(210, 130, 50)']
    },
    type: 'bar'
  }];
  Plotly.newPlot('barChart{{$config['id']}}', data);
</script>


@endpush