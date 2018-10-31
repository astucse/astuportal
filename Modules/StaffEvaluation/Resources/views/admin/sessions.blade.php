@extends('layouts.admin')

@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">

@endsection

@section('content')


<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> Create New Evaluation Session
        	<br> <small>Academic year: 2011, Semester 1</small></li>
      </ul>
      <div class="tab-content">
        <div class="row">
          <form action="{{route('staffevaluation.admin.sessions.create')}}" method="POST">
          @csrf
          <div class="col-xs-6">
            Instructor
            <select class="form-control select2" name="instructor_id" required>
            	@foreach($staff as $s)
            	<option value="{{$s->id}}">{{$s->name}}</option>
            	@endforeach
            </select>
          </div>
          <div class="col-xs-6">
            Course
            <select class="form-control select2" name="course_id" required>
            	@foreach($courses as $s)
            	<option value="{{$s->id}}">{{$s->code}} : {{$s->name}}</option>
            	@endforeach
            </select>
          </div>
          <div class="col-xs-3">
            Target School
            <select class="form-control" name="school_id" required>
	            <option value="0">DoFM</option>
	            @foreach($schools as $d)
            	<option value="{{$d->id}}">{{$d->code}} : {{$d->name}}</option>
            	@endforeach
	        </select>
          </div>
          <div class="col-xs-3">
            Target Department
            <select class="form-control" name="department_id" required>
            	<option value="0">none</option>
            	@foreach($departments as $d)
            	<option value="{{$d->id}}">{{$d->code}} : {{$d->name}}</option>
            	@endforeach
            </select>
          </div>
          <div class="col-xs-2">
            Target Year
            <input type="number" name="target_year" class="form-control" min="1" max="5" placeholder="2/3/4/5" required>
          </div>
          <div class="col-xs-4">
            Target Group
            <select class="form-control select2" multiple="multiple" name="group[]" required>
            	@for($i=1;$i<20;$i++)
            	<option value="{{$i}}">{{$i}}</option>
            	@endfor
            </select>
          </div>
          <div class="col-xs-4">
            Student Evaluation
            <select class="form-control" name="student_evaluation_id" required>
            	@foreach($studentEvaluations as $e)
            	<option value="{{$e->id}}">{{$e->name}}</option>
            	@endforeach
            </select>
          </div>
          <div class="col-xs-4">
            Head Evaluation
            <select class="form-control" name="head_evaluation_id" required>
            	@foreach($headEvaluations as $e)
            	<option value="{{$e->id}}">{{$e->name}}</option>
            	@endforeach
            </select>
          </div>
          <div class="col-xs-4">
            Collegue Evaluation
            <select class="form-control" name="collegue_evaluation_id" required>
            	@foreach($collegueEvaluations as $e)
            	<option value="{{$e->id}}">{{$e->name}}</option>
            	@endforeach
            </select>
          </div>
          <div class="col-xs-4">
            Target Head
            <select class="form-control " name="target_head_id" required>
              @foreach($departmentHeads as $s)
              <option value="{{$s->id}}">{{$s->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-xs-8">
            Target Collegues
            <select class="form-control select2" multiple="multiple" name="target_collegues[]" required>
            	@foreach($staff as $s)
            	<option value="{{$s->id}}">{{$s->name}}</option>
            	@endforeach
            </select>
          </div>
          <div class="col-xs-12">
            <br>
            <button class="btn btn-primary form-control">Create</button>
          </div>
          </form>
        </div>
    </div>
</div>


<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> EvaluationSessions List</li>
      </ul>
      <div class="tab-content">
        <table id="EvaluationTable" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Evaluation Name</th>
            <th>Instructor Name</th>
            <th>Year</th>
            <th>Semester</th>
            <th>Active</th>
            <th>Target Institution</th>
            <th>Target Year</th>
            <th>Target groups</th>
            <th>Target head</th>
            <th>Target collegue</th>
            <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($evaluationSessions as $es)
          	<tr class="">
          		<td>
                <li>{{$es->student_evaluation->name}}</li>
                <li>{{$es->collegue_evaluation->name}}</li>
                <li>{{$es->head_evaluation->name}}</li>
              </td>
            	<td>{{$es->staff->name}}</td>
            	<td>{{$es->academic_year}}</td>
            	<td>{{$es->semester}}</td>
            	<td>
                @if($es->active == 1)
                  Yes
                @else
                  No
                @endif
              </td>
            	<td>
                @if($es->target_year==1)
                Freshman Division
                @else
                {{$es->target_institution->name}}
                @endif
              </td>
              <td>{{$es->target_year}}</td>
              <td>{{$es->target_groups}}</td>
            	<td>{{$es->target_head->name}}</td>
            	<td>
                @foreach($es->collegues as $c)
            		<li>{{$c->name}}</li>
                @endforeach
            	</td>
            	<td>
                @if($es->active)
                <a href="{{route('staffevaluation.admin.evaluation_toggle',['id'=> $es->id, 'toggle'=> 'stop'])}}" class="btn btn-default" ><i class="fa fa-edit"></i> End </a> 
            		@else
                <a href="{{route('staffevaluation.admin.evaluation_toggle',['id'=> $es->id, 'toggle'=> 'start'])}}" class="btn btn-default" ><i class="fa fa-edit"></i>  Start </a> 
                @endif
                <a href="{{route('staffevaluation.admin.session_single',['id'=>$es->id])}}" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a> 
            	</td>
            </tr>
            @endforeach
        </tbody>
        </table>
      </div>
    </div>





@endsection


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Evaluation\ Sessions" ).addClass( "active" );
</script>
<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $('.select2').select2()
    $('#EvaluationTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })

  $('#level').on('change', function() {
    // alert( this.value );
    $("#theSelect option:selected").attr('disabled','disabled').siblings().removeAttr('disabled');
  });
</script>
@endsection