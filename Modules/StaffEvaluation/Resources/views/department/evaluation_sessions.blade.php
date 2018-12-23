@extends('layouts.department')

@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')


@widget('breadcumb',['header'=>'Staff Evaluation Overview ','sub-header'=>'','link0'=>'Home','link1'=>'Staff Evaluation','link9'=>'Evaluation Sessions'])
<br>

<section class="content">
  

<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> Create New Evaluation Session
          <br> <small>Academic year: 2011, Semester 1</small></li>
      </ul>
      <div class="tab-content">
        <div class="row">
          <form action="{{route('staffevaluation.department.sessions.create')}}" method="POST">
          @csrf
          <div class="col-xs-6">
            Instructor
            <select class="form-control select2" name="assignment_id" required>
              @foreach($assignments as $a)
              <option value="{{$a->id}}">
                {{$a->instructor->name}} : {{$a->course->name}} : Year {{$a->batch_year}}
              </option>
              @endforeach
            </select>
          </div>
          
          <div class="col-xs-4">
            Target Group
            <select class="form-control select2" multiple="multiple" name="group[]" required>
              @for($i=1;$i<20;$i++)
              <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
          <div class="col-xs-12">
            
          </div>
          <div class="col-xs-3">
            Student Evaluation
            <select class="form-control" name="student_evaluation_id" required>
              @foreach($studentEvaluations as $e)
              <option value="{{$e->id}}">{{$e->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-xs-3">
            Head Evaluation
            <select class="form-control" name="head_evaluation_id" required>
              @foreach($headEvaluations as $e)
              <option value="{{$e->id}}">{{$e->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-xs-3">
            Collegue Evaluation
            <select class="form-control" name="collegue_evaluation_id" required>
              @foreach($collegueEvaluations as $e)
              <option value="{{$e->id}}">{{$e->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-xs-3">
            Target Head
            <select class="form-control " name="target_head_id" required>
              <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
            </select>
          </div>

          <div class="col-xs-12">
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
        <li class="pull-left header"><i class="fa fa-th"></i>
        EvaluationSessions List <small>Year: 2011, Semester: 1 </small>
        </li>
      </ul>
      <div class="tab-content">
        <table id="EvaluationTable" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Instructor / Course </th>
            <th>Active</th>
            <th>Target Year</th>
            <th>Target groups</th>
            <!-- <th>Target head</th> -->
            <th>Collegue</th>
            <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sessionss as $staff_id=>$sessions)
            <tr class="">
              <td><br>{{$sessions[0]->staff->name}}</td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <a href="{{route('staffevaluation.department.session_report',['id'=>$staff_id])}}" class="btn btn-primary btn-sm" ><i class="fa fa-edit"></i> Generate Letter </a> </td>
            </tr>
            @foreach($sessions as $es)
            <tr class="">
              <td>{{$es->course->code}} : {{$es->course->name}}</td>
              <td>
                @if($es->active == 1)
                  Yes
                @else
                  No
                @endif
              </td>
              <td>{{$es->target_year}}</td>
              <td>{{$es->target_groups}}</td>
              <!-- <td>{{$es->target_head->name}}</td> -->
              <td>
                @foreach($es->collegues as $c)
                <li>{{$c->name}}</li>
                @endforeach
              </td>
              <td>
                @if($es->active)  
                <a href="{{route('staffevaluation.department.evaluation_toggle',['id'=> $es->id, 'toggle'=> 'stop'])}}" class="btn btn-sm btn-default" ><i class="fa fa-edit"></i> End </a> 
                @else
                <a href="{{route('staffevaluation.department.evaluation_toggle',['id'=> $es->id, 'toggle'=> 'start'])}}" class="btn btn-sm btn-default" ><i class="fa fa-edit"></i>  Start </a> 
                @endif
                <br>
                <a href="{{route('staffevaluation.department.session_single',['id'=>$es->id])}}" class="btn btn-sm btn-default" ><i class="fa fa-edit"></i> Detail </a> 
              </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
        </table>
      </div>
    </div>

</section>


@endsection


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Sessions" ).addClass( "active" );
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