@extends('layouts.admin')

@section('content')

		<h3>Equation</h3>
		<div class="row">
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
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
          </form>
        </div>
@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Setting" ).addClass( "active" );
</script>
@endsection