@extends('layouts.employee')

@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')

@widget('SillyPack',['ckeditor' => true ])

<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab_0" data-toggle="tab">General</a></li>
		<li><a href="#tab_1" data-toggle="tab">Agendas</a></li>
		<li><a href="#tab_2" data-toggle="tab">Discussion Room</a></li>
		<!-- <li class="pull-right"><a class="text-muted" href="#tab_666" data-toggle="tab"><i class="fa fa-gear"> For Admins </i></a></li> -->
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab_0">
			Name: {{$meeting->title}}<br>
			Date: {{$meeting->planned_time}} <br>
			Attendees <br>
			@foreach($meeting->participants as $m)
			<li><i class="fa fa-check-circle"></i> {{$m->name}}</li>
			@endforeach
			@foreach($meeting->group->members->diff($meeting->participants) as $m)
			<li><i class="fa fa-remove"></i> {{$m->name}}</li>
			@endforeach

			<!-- <a href="{{route('meetingmanagement.employee.meeting_stop',['id'=>$meeting->id])}}" class="btn btn-primary">STOP</a> -->
		</div>
		<div class="tab-pane " id="tab_1">
			<form action="{{route('meetingmanagement.employee.agenda.create')}}" method="POST">
	          {{ csrf_field() }}
	          <input type="number" value="{{$meeting->id}}" name="meeting_id" hidden required>
	          Title <br>
	          <input type="text" name="title" class="form-control" required> <br>
	          Body <br>
	          <textarea name="body" class="form-control" rows="6" required></textarea> <br>
	          <button type="submit" class="btn btn-primary">Add</button>
	      	</form>
	      	<table class="table table-striped">
				<tr style="font-weight: bold;">
					<td>#</td>
					<td>Title</td>
					<td>Body</td>
					<td>By</td>
				</tr>
				@foreach($meeting->agendas as $k=>$agenda)
				<tr >
					<td>{{$k+1}}</td>
					<td>{{$agenda->title}}</td>
					<td>{{$agenda->body}}</td>
					<td>{{$agenda->raised_by->name}}</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div class="tab-pane " id="tab_2">
			<form action="{{route('meetingmanagement.employee.decision.create')}}" method="POST">
	          {{ csrf_field() }}
	          <input type="number" value="{{$meeting->id}}" name="meeting_id" hidden required>
	          <h3>{{$meeting->title}} </h3>
	          <!-- <input type="text" name="title" class="form-control" required> <br> -->
	          Decision <br> 
	          @if($meeting->group->admin->is(Auth::user()))
	          <!-- <textarea name="decision" class="form-control" rows="10" required>{{$meeting->decision}}</textarea><br> -->
	          <textarea id="editor1"  name="decision"  rows="10" >{{$meeting->decision}}</textarea>
	          <button type="submit" class="btn btn-primary">Update</button>
	          @if(!$meeting->participants->contains(Auth::user()))
	          <a class="btn btn-primary" href="{{route('meetingmanagement.employee.meeting.sign',['id'=>$meeting->id])}}"><i class="fa fa-check-square"></i>Sign</a>
	          @endif
	          @else
	          <textarea id="editor1"  name="decision"  rows="10" disabled="">{{$meeting->decision}}</textarea>
	          @if(!$meeting->participants->contains(Auth::user()))
	          <a class="btn btn-primary" href="{{route('meetingmanagement.employee.meeting.sign',['id'=>$meeting->id])}}"><i class="fa fa-check-square"></i>Sign</a>
	          @endif	
	          @endif
	      	</form>
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
<script src="{{url('bower_components/ckeditor/ckeditor.js')}}"></script>
<script>
  $(function () {
    CKEDITOR.replace('editor1')
    // CKEDITOR.replace('editor2')
    // CKEDITOR.replace('editor3')
    // $('.textarea').wysihtml5()
  })
</script>

@endsection