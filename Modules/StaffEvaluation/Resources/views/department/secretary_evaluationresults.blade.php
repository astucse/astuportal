@extends('layouts.employee')
@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')
@widget('breadcumb',['header'=>'Staff Evaluation Overview ','sub-header'=>'','link0'=>'Home','link1'=>'Staff Evaluation','link9'=>'Evaluation Sessions'])
<br>
<section class="content">
  

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
                <a href="{{route('staffevaluation.secretary.session_report',['id'=>$staff_id])}}" class="btn btn-primary btn-sm" ><i class="fa fa-edit"></i> Generate Letter </a> </td>
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
                On Progress
                <!-- <a href="{{route('staffevaluation.department.evaluation_toggle',['id'=> $es->id, 'toggle'=> 'stop'])}}" class="btn btn-sm btn-default" ><i class="fa fa-edit"></i> End </a>  -->
                @else
                Ended
                <!-- <a href="{{route('staffevaluation.department.evaluation_toggle',['id'=> $es->id, 'toggle'=> 'start'])}}" class="btn btn-sm btn-default" ><i class="fa fa-edit"></i>  Start </a>  -->
                @endif
                <br>
                <!-- <a href="{{route('staffevaluation.department.session_single',['id'=>$es->id])}}" class="btn btn-sm btn-default" ><i class="fa fa-edit"></i> Detail </a>  -->
              </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
        </table>
      </div>
    </div>

</section>


@stop


@section('js')
<script type="text/javascript"> 
  $( "#secretary" ).addClass( "active" );
  $( "#secretary-1" ).addClass( "active" );
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