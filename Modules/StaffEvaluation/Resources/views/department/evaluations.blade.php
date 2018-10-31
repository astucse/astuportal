@extends('layouts.department')

@section('content')

<div class="nav-tabs-custom">
  <ul class="nav nav-tabs pull-right">
    <li class="pull-left header"><i class="fa fa-th"></i> Evaluations</li>
  </ul>
  <div class="tab-content">
    @if(sizeof($evaluations)==0)
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
        @foreach($evaluations as $eva)
                      <tr class="">
          <td>{{$eva->staff->name}}</td>
          <td>{{$eva->course->code}} : {{$eva->course->name}}</td>
          <td>
            <a href="{{route('staffevaluation.department.evaluations_single',['id'=>$eva->id])}}" class="btn btn-default" ><i class="fa fa-edit"></i> Evaluate </a> </td>
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
  $( "#staffevaluation-Evaluations" ).addClass( "active" );
</script>
@endsection