@extends('layouts.department',['nojs'=>false])


@section('css')
@endsection
@section('content')

@widget('breadcumb',['header'=>'Students','link0'=>'Home','link1'=>'Users','link9'=>'students'])
<section class="content">

  <div class="box" id="app">
  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Actions</h3>
    </div>
    <div class="box-body">
      Export : <a class="btn btn-primary" href="{{route('admin.students.export')}}">Export</a><br>
    </div>
    <div class="box-footer">
    </div>
  </div>
<div class="nav-tabs-custom">
      @for($y = 2;$y<=5;$y++)
      <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Batch Year : {{$y}}</h3>
      </div>
      <div class="box-body">
        <table id="StudentsTable{{$y}}" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Instructor</th>
            <!-- <th>Group</th> -->
            <th></th>
            </tr>
          </thead>
          <tbody>
              @foreach($breakdowns as $g)
              @if($g->year == $y)
              @foreach($g->allCoursess as $c)
            <tr class="">
              <td>{{$c->code}}</td>
              <td>{{$c->name}}</td>
              <td></td>
              <td>
              	<button 
              	data-group="{{$g->id}}" 
              	data-course="{{$c}}" 
              	type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-edit">
	                Assign Instructor
	              </button>
              </td>
            </tr>
            @endforeach
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
      </div>
      @endfor
    </div>


    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          	</button>
            <h4 class="modal-title">Assign Instructor</h4>
          </div>
            <div class="modal-body-detail">
              <h5>Course</h5>
              <select name="name" id="modalCourseId" class="form-control">
              	<option id="courseName" selected></option>
              </select>
              <h5>Instructor</h5>
              <select name="sex" id="modalInstructorId" class="form-control">
              	@foreach($instructors as $i)
                <option value="{{$i->id}}">{{$i->name}}</option>
                @endforeach
              </select>
              <input name="groupid" id="modalGroupId" hidden type="number">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button onclick="assign()" class="btn btn-primary"  >Save changes</button>
            </div>

        </div>
      </div>
    </div>
</section>
@endsection



@section('js')
<script src="{{ asset('js/vue.min.js') }}"></script>
@endsection