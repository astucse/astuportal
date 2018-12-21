@extends('layouts.employee')

@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('content')

<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab_0" data-toggle="tab">General</a></li>
		<li><a href="#tab_1" data-toggle="tab">Meetings</a></li>
		<li><a href="#tab_2" data-toggle="tab">Members</a></li>
		<li class="pull-right"><a class="text-muted" href="#tab_666" data-toggle="tab"><i class="fa fa-gear"> For Admins </i></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab_0">
			Name: {{$group->name}}
		</div>
		<div class="tab-pane" id="tab_1">
			<form action="{{route('meetingmanagement.employee.meeting.create')}}" method="POST">
	          {{ csrf_field() }}
	          <input type="number" value="{{$group->id}}" name="group_id" hidden>
	          Title<br>
				<input type="text" name="title" class="form-control">
				Time<br>
				<input class="form-control" type="datetime-local" id="planned_time" name="planned_time"  />
				<br>
				<button type="submit" class="btn btn-primary">Save changes</button>
	      </form>
	      <table class="table table-striped">
				<tr style="font-weight: bold;">
					<td>Name</td>
					<td>Date</td>
					<td>Agendas</td>
					<td></td>
				</tr>
				@foreach($group->meetings as $meeting)
				<tr>
					<td>{{$meeting->title}}</td>
					<td>{{$meeting->planned_time}}</td>
					<td>{{$meeting->agendas->count()}}</td>
					<td> <a href="{{route('meetingmanagement.employee.meeting_single',['id'=>$meeting->id])}}" class="btn btn-default">Detail</a></td>
				</tr>
				@endforeach
			</table>

		</div>
		<div class="tab-pane " id="tab_2">
			<table class="table table-striped">
				<tr style="font-weight: bold;">
					<td>Name</td>
					<td>Role</td>
				</tr>
				@foreach($group->members as $member)
				<tr>
					<td>{{$member->name}}</td>
					<td>
						@if($member->is($group->creator))
						<li>Creator</li>
						@endif
						@if($member->is($group->admin))
						<li>Admin</li>
						@endif
						<li>Member</li>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div class="tab-pane" id="tab_666">
			@if($group->admin->is(Auth::user()))
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Manage Members</h3>
				</div>
				<div class="box-body no-padding">
					<table class="table table-striped">
						<tr>
							<td>Add Members</td>
							<td>
								<form action="{{route('meetingmanagement.employee.member_add')}}" method="post">
									@csrf
								<div class="rows">
									<input type="number" name="group_id" value="{{$group->id}}" hidden>
									<div class="col-sm-8">
										<select style="width: 100%" class="form-control select2" name="members[]" multiple>
											@foreach($employees as $e)
											<option value="{{$e->id}}" class="form-control">{{$e->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-sm-4">
									<button class="btn btn-primary" type="submit">Add</button>
									</div>
								</div>
								</form>
							</td>
						</tr>
						<!-- <tr>
							<td></td>
							<td></td>
						</tr> -->
					</table>
				</div>
				<div class="box-header">
					<h3 class="box-title">General Setting</h3>
				</div>
				<div class="box-body no-padding">
					<table class="table table-striped">
							<form method="post" action="{{route('meetingmanagement.employee.edit')}}">
								@csrf
									<input type="number" name="group_id" value="{{$group->id}}" hidden>
						<tr>
								<td>Name</td>
								<td>
									<input type="text" value="{{$group->name}}" name="group_name">
								</td>
						</tr>
						<tr>
							<td></td>
								<td>
									<button type="submit" class="btn btn-primary">Change</button>
								</td>
							</tr>
							</form>
					</table>
				</div>
			</div>
			@else
			You are NOT an Admin.
			@endif
		</div>
	</div>
</div>

@stop



@section('js')
<script type="text/javascript">
  $( "#meetingmanagement" ).addClass( "active" );
  // $( "#meetingmanagement-Create" ).addClass( "active" );
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