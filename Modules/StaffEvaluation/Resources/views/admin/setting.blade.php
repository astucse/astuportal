@extends('layouts.admin')

@section('content')

@widget('breadcumb',['header'=>'Setting','sub-header'=>'','link0'=>'Home','link1'=>'Staff Evaluation','link9'=>'Setting'])

<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Equation</h3>
    </div>
    <div class="box-body">
      <form action="{{route('staffevaluation.admin.quation.update')}}" method="POST">
          {{ csrf_field() }}
          <div class="col-xs-2">
            <div class="form-group">
              <label>Student</label><br>
              <input name="weight_s" type="number" min="0" max="100" value="{{$weight_student}}"> %
            </div>
          </div>
          <div class="col-xs-1">
            <h2>+</h2>
          </div>
          <div class="col-xs-2">
            <div class="form-group">
              <label>Collegues</label><br>
              <input name="weight_c" type="number" min="0" max="100" value="{{$weight_collegue}}"> %
            </div>
          </div>
          <div class="col-xs-1">
            <h2>+</h2>
          </div>
          <div class="col-xs-2">
            <div class="form-group">
              <label>Heads</label><br>
              <input name="weight_h" type="number" min="0" max="100" value="{{$weight_head}}"> %
            </div>
          </div>
          <div class="col-xs-2">
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
          </form>
    </div>
  </div>

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Evaluation Points</h3>
    </div>
    <div class="box-body">
      <form action="{{route('options.staffevaluation.good_bad_points')}}" method="POST">
        @csrf
        Good > <input type="number" step="0.01" name="point_good" value="{{$point_good}}"> <br>
        Bad < <input type="number" step="0.01" name="point_bad" value="{{$point_bad}}"> <br>
        <button class="btn btn-primary">Submit</button>
      </form>
    </div>
    <!-- /.box-body -->
  </div>

      </section>
@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Setting" ).addClass( "active" );
</script>
@endsection