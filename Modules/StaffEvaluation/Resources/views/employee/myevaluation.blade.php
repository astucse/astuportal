@extends('layouts.employee')

@section('content')

<div class="nav-tabs-custom">
  <ul class="nav nav-tabs pull-right">
    <li class="pull-left header"><i class="fa fa-th"></i>Current Evaluations</li>
  </ul>
  <div class="tab-content">
    @if(sizeof($evaluations['current'])==0)
        <tr>
          <p>Nothing  to show</p>
        </tr>
    @else
    <table id="AdminsTable" class="table table-bordered table-striped">
      <thead>
        <tr>
        <th>Instructor</th>
        <th>Course</th>
        <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($evaluations['current'] as $eva)
                      <tr class="">
          <td>{{$eva->staff->name}}</td>
          <td>{{$eva->course->code}} : {{$eva->course->name}}</td>
          <td>
             <a href="{{route('staffevaluation.employee.myevaluation_single',['id'=>$eva->id])}}" class="btn btn-default disabled" ><i class="fa fa-edit"></i> Detail </a> 
          </td>
        </tr>
        @endforeach
                  </tbody>
    </table>
    @endif
    
  </div>


  <ul class="nav nav-tabs pull-right">
    <li class="pull-left header"><i class="fa fa-th"></i>Past Evaluations</li>
  </ul>
  <div class="tab-content">
    @if(sizeof($evaluations['past'])==0)
        <tr>
          <p>Nothing  to show</p>
        </tr>
    @else
    <table id="AdminsTable" class="table table-bordered table-striped">
      <thead>
        <tr>
        <th>Instructor</th>
        <th>Course</th>
        <th>Result</th>
        <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($evaluations['past'] as $eva)
                      <tr class="">
          <td>{{$eva->staff->name}}</td>
          <td>{{$eva->course->code}} : {{$eva->course->name}}</td>
          <td>{{$eva->results['all']}}</td>
          <td>
            <a href="{{route('staffevaluation.employee.myevaluation_single',['id'=>$eva->id])}}" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a> 
          </td>
        </tr>
        @endforeach
                  </tbody>
    </table>
    @endif
    
  </div>
</div>


@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-MyEvaluations" ).addClass( "active" );
</script>
@endsection