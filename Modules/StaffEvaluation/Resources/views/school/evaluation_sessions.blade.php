@extends('layouts.school')

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
            <th>Instructor Name</th>
            <th>Department</th>
            <th>Result Net</th>
            <th>Result Student</th>
            <th>Result Collegue</th>
            <th>Result Head</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sessions as $es)
            <tr class="">
              <td>{{$es->staff->name}}</td>
              <td>
                @if($es->target_year==1)
                Freshman Division
                @else
                {{$es->target_institution->name}}
                @endif
              </td>
              <td>
                {{$es->staff->net_performance[$this_year][$this_semester]['all']}}
              </td>
              <td>
                {{$es->staff->net_performance[$this_year][$this_semester]['student']}}
              </td>
              <td>
                {{$es->staff->net_performance[$this_year][$this_semester]['collegue']}}
              </td>
              <td>
                {{$es->staff->net_performance[$this_year][$this_semester]['head']}}
              </td>
            </tr>
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