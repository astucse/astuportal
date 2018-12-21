@extends('layouts.admin')





@section('content')

@widget('breadcumb',['header'=>'Schedule',
	'sub-header'=>'<a class="badge bg-white">Year : '.$group->batch_year.'</a><a class="badge bg-white">'.$group->institution->name.' Department</a>'.'</a><a class="badge bg-white">Group '.$group->name.'</a>',
	'link0'=>'Home','link1'=>'Academic','link2'=>'Group','link9'=>'Schdule'])


<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
            	<form action="{{route('academic.admin.schedule.create')}}" method="POST">
            		@csrf
            		<input type="number" name="group_id" value="{{$group->id}}" hidden>
		        <div class="col-md-3">
	            	<select class="form-control" name="day">
	            		<option value="0">Day of the week</option>
	            		<option value="monday">Monday</option>
	            		<option value="tuesday">Tuesday</option>
	            		<option value="wednesday">Wednesday</option>
	            		<option value="thursday">Thursday</option>
	            		<option value="friday">Friday</option>
	            		<option value="saturday">Saturday</option>
	            		<option value="sunday">Sunday</option>
	            	</select>
	            </div>
	            <div class="col-md-3">
	            	<select class="form-control" name="course_id">
	            		<option value="0">Course</option>
	            		@foreach($group->breakdown->coursess as $c)
	            		<option value="{{$c->id}}">{{$c->name}}</option>
	            		@endforeach
	            		@foreach($group->breakdown->electivess as $e)
	            		@foreach($e->coursess as $c)
	            		<option value="{{$c->id}}">{{$c->name}}</option>
	            		@endforeach
	            		@endforeach
	            	</select>
	            </div>
	            <div class="col-md-5">
	            	<select class="" name="from_hour">
	            		@for($i=0;$i<12;$i++)
	            		<option value="{{$i}}">{{$i}}</option>
	            		@endfor
	            	</select>
	            	:<select class="" name="from_minute">
	            		@for($i=0;$i<60;$i++)
	            		<option value="{{$i}}">{{$i}}</option>
	            		@endfor
	            	</select>
	            	<select class="" name="from_ampm">
	            		<option value="0">AM</option>
	            		<option value="1">PM</option>
	            	</select>
	            	to
	            	<select class="" name="to_hour">
	            		@for($i=0;$i<12;$i++)
	            		<option value="{{$i}}">{{$i}}</option>
	            		@endfor
	            	</select>
	            	:<select class="" name="to_minute">
	            		@for($i=0;$i<60;$i++)
	            		<option value="{{$i}}">{{$i}}</option>
	            		@endfor
	            	</select>
	            	<select class="" name="to_ampm">
	            		<option value="0">AM</option>
	            		<option value="1">PM</option>
	            	</select>
	            </div>
	            <div class="col-md-1">
	            	<button type="submit" class="form-control btn btn-primary">Create</button>
	            </div>
	        </form>

              <!-- <h3 class="box-title">Bordered Table</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 80px">Day</th>
                  <th>Schedules</th>
                  <th style="width: 40px"></th>
                </tr>
                <tr>
                  <td>Monday</td>
                  <td>
                  	@foreach($monday as $d)
                  	{{$d->starts}} - {{$d->ends}} : {{$d->course->name}}<br><br>
                  	@endforeach
                  </td>
                  <td><span class="badge bg-red">Edit</span></td>
                </tr>
                <tr>
                  <td>Tuesday</td>
                  <td>
                  	@foreach($tuesday as $d)
                  	{{$d->starts}} - {{$d->ends}} : {{$d->course->name}}<br><br>
                  	@endforeach
                  </td>
                  <td><span class="badge bg-red">Edit</span></td>
                </tr>
                <tr>
                  <td>Wednesday</td>
                  <td>
                  	@foreach($wednesday as $d)
                  	{{$d->starts}} - {{$d->ends}} : {{$d->course->name}}<br><br>
                  	@endforeach
                  </td>
                  <td><span class="badge bg-red">Edit</span></td>
                </tr>
                <tr>
                  <td>Thursday</td>
                  <td>
                  	@foreach($thursday as $d)
                  	{{$d->starts}} - {{$d->ends}} : {{$d->course->name}}<br><br>
                  	@endforeach
                  </td>
                  <td><span class="badge bg-red">Edit</span></td>
                </tr>
                <tr>
                  <td>Friday</td>
                  <td>
                  	@foreach($friday as $d)
                  	{{$d->starts}} - {{$d->ends}} : {{$d->course->name}}<br><br>
                  	@endforeach
                  </td>
                  <td><span class="badge bg-red">Edit</span></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.box -->
</div>
</div>
</section>



@endsection()





@section('js')
@section('js')
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-Groups" ).addClass( "active" );
</script>

@endsection
