@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{url('bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')

@widget('breadcumb',['header'=>'Roles management','sub-header'=>'','link0'=>'Academics','link9'=>'roles management'])
<div class="box">
	<!-- <div class="box-header"> -->
		<!-- <h3 class="box-title">Roles Management</h3> -->
	<!-- </div> -->
	<div class="box-body no-padding">
		<table class="table table-striped">
			<tr>
				<td>1.</td>
				<td><b>AUTHORITY</b></td>
				<td id="authlist"></td>
			</tr>
			<tr>
				<td></td>
				<td>School Dean</td>
				<td>
					<form enctype="multipart/form-data" action="{{route('admin.roles.create')}}" method="POST">
                      {{ csrf_field() }}
                        <div class="col-md-5">
                          <input type="text" name="code" value="A_SDN" hidden>
                          <input type="text" name="rolegiver_type" value="Academic\School" hidden>
                          <select class="form-control select2" name="staff" data-placeholder="Select from Staff">
                            @foreach($employees as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                          </select>  
                        </div>
                        <div class="col-md-5">
                          <select class="form-control" name="rolegiver_id" data-placeholder="School">
                            @foreach($schools as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                          </select>  
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="form-control btn btn-primary">Add</button>
                        </div>
                    </form>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					@foreach(collect($roles)->where('code','A_SDN')->first()->assignment as $a )
					{{$a->roletaker->name}} -> {{$a->rolegiver->name}}<br>
					@endforeach
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Department Head</td>
				<td>
					<form enctype="multipart/form-data" action="{{route('admin.roles.create')}}" method="POST">
                      {{ csrf_field() }}
                        <div class="col-md-5">
                          <input type="text" name="code" value="A_DHN" hidden>
                          <input type="text" name="rolegiver_type" value="Academic\Department" hidden>
                          <select class="form-control select2" name="staff" data-placeholder="Select from Staff">
                            @foreach($employees as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                          </select>  
                        </div>
                        <div class="col-md-5">
                          <select class="form-control" name="rolegiver_id" data-placeholder="School">
                            @foreach($departments as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                          </select>  
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="form-control btn btn-primary">Add</button>
                        </div>
                    </form>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					@foreach(collect($roles)->where('code','A_DHN')->first()->assignment as $a )
					{{$a->roletaker->name}} -> {{$a->rolegiver->name}}<br>
					@endforeach
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection



@section('js')
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-Roles" ).addClass( "active" );
</script>
<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  $('.select2').select2();
</script>
@endsection