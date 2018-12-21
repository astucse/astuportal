@extends('layouts.employee')

@section('content')

<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> My Groups</li>
      </ul>
      <div class="tab-content">
        <table id="EvaluationTable" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Group name </th>
            <th>Members</th>
            <th></th>
            </tr>
          </thead>
          <tbody>
          	@foreach($groups as $g)
          	<tr class="">
          		<td>{{$g->name}}</td>
          		<td>
          			{{$g->members->random()->name}}, {{$g->members->random()->name}} and {{$g->count() - 2}} Others
          		</td>
          		<td><a class="btn btn-primary" href="{{route('meetingmanagement.employee.group_single',['id'=>$g->id])}}">View</a></td>
          	</tr>
          	@endforeach
          </tbody>
      </table>
  </div>
</div>

@stop



@section('js')
<script type="text/javascript">
  $( "#meetingmanagement" ).addClass( "active" );
  $( "#meetingmanagement-MyGroups" ).addClass( "active" );
</script>
@endsection