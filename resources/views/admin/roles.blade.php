@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{url('bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')

@widget('breadcumb',['header'=>'Roles management','sub-header'=>'','link0'=>'Academics','link9'=>'roles management'])
<section class="content">
  
<div class="box">
	<div class="box-body no-padding">
		<table class="table table-striped">
			<tr>
				<td></td>
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
                          <input type="text" name="rolegiver_type" value="Org\School" hidden>
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
					{{$a->roletaker->name}} -> {{$a->rolegiver->name}} <a href="{{route('admin.roleassign.destroy',['id'=>$a->id])}}" class="btn btn-danger">Delete</a> <br>
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
                          <input type="text" name="rolegiver_type" value="Org\Department" hidden>
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
					{{$a->roletaker->name}} -> {{$a->rolegiver->name}} <a href="{{route('admin.roleassign.destroy',['id'=>$a->id])}}" class="btn btn-danger">Delete</a><br>
					@endforeach
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
  <div class="box-body no-padding">
    <table class="table table-striped">
      <tr>
        <td></td>
        <td><b>Position</b></td>
        <td id="authlist"></td>
      </tr>
      <tr>
        <td></td>
        <td>Secretary</td>
        <td>
          <form enctype="multipart/form-data" action="{{route('admin.roles.create')}}" method="POST">
              {{ csrf_field() }}
                <div class="col-md-4">
                  <input type="text" name="code" value="P_SEC" hidden>
                  <input type="text" name="rolegiver_type" value="Org\Office" hidden>
                  <select class="form-control select2" name="staff" data-placeholder="Select from Staff">
                    @foreach($employees as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                  </select>  
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="rolegiver_id" data-placeholder="School">
                    @foreach($offices as $s)
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
          @foreach(collect($roles)->where('code','P_SEC')->first()->assignment as $a )
          {{$a->roletaker->name}} -> {{$a->rolegiver->name}}<br>
          @endforeach
        </td>
      </tr>
      <tr>
        <td></td>
        <td>Instructor</td>
        <td>
          <form enctype="multipart/form-data" action="{{route('admin.roles.create')}}" method="POST">
              {{ csrf_field() }}
                <div class="col-md-4">
                  <input type="text" name="code" value="P_INS" hidden>
                  <input type="text" name="rolegiver_type" value="Org\Department" hidden>
                  <select class="form-control select2" name="staff" data-placeholder="Select from Staff">
                    @foreach($employees as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                  </select>  
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="rolegiver_id" data-placeholder="School">
                    @foreach($departments as $d)
                    <option value="{{$d->id}}">{{$d->name}}</option>
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
        {{-- 
        <td></td>
        <td></td>
        <td>
          @foreach(collect($roles)->where('code','P_INS')->first()->assignment as $a )
          {{$a->roletaker->name}} -> {{$a->rolegiver->name}}<br>
          @endforeach
        </td>
        --}}
      </tr>
      <tr>
        <td></td>
        <td>Students => Department</td>
        <td>
          <form enctype="multipart/form-data" action="{{route('admin.roles.create')}}" method="POST">
              {{ csrf_field() }}
                <div class="col-md-4">
                  <input type="text" name="code" value="P_STU" hidden>
                  <input type="text" name="rolegiver_type" value="Org\Department" hidden>
                  <input type="text" name="roletaker_type" value="student" hidden>
                  <select class="form-control select2" name="staff" data-placeholder="Select from Staff">
                    @foreach($students as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                  </select>  
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="rolegiver_id" data-placeholder="School">
                    @foreach($departments as $d)
                    <option value="{{$d->id}}">{{$d->name}}</option>
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
        <td>Students => School</td>
        <td>
          <form enctype="multipart/form-data" action="{{route('admin.roles.create')}}" method="POST">
              {{ csrf_field() }}
                <div class="col-md-4">
                  <input type="text" name="code" value="P_STU" hidden>
                  <input type="text" name="rolegiver_type" value="Org\School" hidden>
                  <input type="text" name="roletaker_type" value="student" hidden>
                  <select class="form-control select2" name="staff" data-placeholder="Select from Staff">
                    @foreach($students as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                  </select>  
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="rolegiver_id" data-placeholder="School">
                    @foreach($schools as $d)
                    <option value="{{$d->id}}">{{$d->name}}</option>
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
        
      </tr>
    </table>
  </div>
</div>



</section>
@endsection



@section('js')
<script type="text/javascript">
  $( "#users" ).addClass( "active" );
  $( "#Roles" ).addClass( "active" );
</script>
<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  $('.select2').select2();
</script>
@endsection