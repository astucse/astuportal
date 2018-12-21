@extends('layouts.department')


@section('css')
<style>
.example-modal .modal {
  position: relative;
  top: auto;
  bottom: auto;
  right: auto;
  left: auto;
  display: block;
  z-index: 1;
}
.example-modal .modal {
  background: transparent !important;
}
</style>
@endsection
@section('content')

@widget('breadcumb',['header'=>'Students','link0'=>'Home','link1'=>'Users','link9'=>'students'])
<section class="content">
  
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Actions</h3>
    </div>
    <div class="box-body">
      Export : <a class="btn btn-primary" href="{{route('admin.students.export')}}">Export</a><br>
      <!-- <form enctype="multipart/form-data" action="@{{route('admin.super.import', ['type'=>'student'])}}" method="POST">
        {{ csrf_field() }}
        <input type="file" name="zzzz" id="zzzz" class="">
        <button type="submit" class="btn btn-primary">Import</button>
      </form> -->
    </div>
    <div class="box-footer">
      <!-- Footer -->
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->


<div class="nav-tabs-custom">
      <!-- <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> Students</li>
        
        
      </ul> -->

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
              <td>
                @foreach($g->assignment as $assignment)
                @if($assignment->course_id == $c->id)
                <small class="label bg-green">{{$assignment->instructor->name}}</small> 
                @endif
                @endforeach
              </td>
              <td>
              	<button 
              	data-group="{{$g->id}}" 
                data-course="{{$c}}" 
              	data-year="{{$y}}" 
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
              <input name="yearid" id="yearName" hidden type="number">
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


<script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.editor.min.js') }}"></script>
<meta name="_token" content="{!! csrf_token() !!}" />
<script>
	function assign(){
	    var di = document.getElementById('modalInstructorId');
	    // console.log(di)
	    var i = document.getElementById('modalInstructorId').value;
	    // var g = document.getElementById('modalGroupId').value;
      var c = document.getElementById('courseName').value;
	    var y = document.getElementById('yearName').value;

	    formData = new FormData();
	    formData.append("instructor",i);
      formData.append("course",c);
	    formData.append("year",y);
	    // formData.append("group",g);
	    $.ajax({
	        type: "POST",
	        url: "{{route('academic.department.instructors.assign.api')}}",
	        data: formData,
	        processData: false,
	        contentType:  false,
	        dataType: 'json',
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	        },
	        success: function (data) {
            
	          // console.log("success",data)
	          // var rr = '<span class="badge bg-blue">'+t+'</span>';
	          // mydiv = document.getElementById(list);
	          // mydiv.innerHTML += " "+" "+rr;
	          // document.getElementById(title).value = "";
	          // document.getElementById(code).value = "";
	        },
	        error: function (data) {
	        	console.log('hehehe: ',c);
	            console.log('Error:', data);
	        }
	    });
	  }
</script>
<script>
  $('#modal-edit').on('show.bs.modal', function(e) {
    var group = $(e.relatedTarget).data('group');
    var course = $(e.relatedTarget).data('course');
    var year = $(e.relatedTarget).data('year');

    console.log("group ", group);
    console.log(course.name);
    $("#courseName").text(course.name);
    $("#modalGroupId").val(group.id);
    $("#courseName").val(course.id);
    $("#yearName").val(year);

    // $("#modalName").val(obj.name);
    // $("#modalEmail").val(obj.email);
    // $("#modalGroup").val(obj.enrolls[0].group);
    // $("#modalSex").val(obj.sex).change();
    // console.log(obj)
  });
  $(function () {
    $('#StudentsTable2').DataTable({
      'paging'      : true,'lengthChange': false,'searching'   : true,'ordering'    : true,'info'        : true,'autoWidth'   : true
    })
    $('#StudentsTable3').DataTable({
      'paging'      : true,'lengthChange': false,'searching'   : true,'ordering'    : true,'info'        : true,'autoWidth'   : true
    })
    $('#StudentsTable4').DataTable({
      'paging'      : true,'lengthChange': false,'searching'   : true,'ordering'    : true,'info'        : true,'autoWidth'   : true
    })
    $('#StudentsTable5').DataTable({
      'paging'      : true,'lengthChange': false,'searching'   : true,'ordering'    : true,'info'        : true,'autoWidth'   : true
    })
  })
</script>
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-Instructors" ).addClass( "active" );
</script>
@endsection