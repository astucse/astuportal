@extends('layouts.department')

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
            <th>Name</th>
            <th>Email</th>
            <th>Sex</th>
            <th>Group</th>
            <th></th>
            </tr>
          </thead>
          <tbody>
              @foreach($groups as $g)
              @if($g->batch_year == $y)
              @isset($g->enrollments)
              @foreach($g->enrollments as $e)
            <tr class="">
              <td>{{$e->student->name}}</td>
              <td>{{$e->student->email}}</td>
              <td>{{$e->student->sex}}</td>
              <td>{{$g->name}}</td>
              <td>
                <!-- <a href="{{route('user.password_reset',['type'=>'student','id'=>$e->student->id])}}" class="btn btn-default" ><i class="fa fa-edit"></i> Reset Password </a>  -->
              </td>
            </tr>
            @endforeach
            @endisset
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
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Student Info</h4>
          </div>
          <form enctype="multipart/form-data" action="@{{route('admin.edit.students')}}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body-detail">
              <h5>Name</h5>
              <input name="id" type="number" id="modalId" hidden>
              <input id="modalName" name="name" class="form-control" type="text">
              <h5>Email</h5>
              <input id="modalEmail" name="email" class="form-control" type="text">
              <h5>Sex</h5>
              <select name="sex" id="modalSex" class="form-control">
                <option value="F">Female</option>
                <option value="M">Male</option>
              </select>
              <h5>Group</h5>
              <input name="group" id="modalGroup" class="form-control" type="number">
              <input name="groupid" id="modalGroupId" hidden type="number">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"  >Save changes</button>
            </div>
          </form>
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
<script>
  $('#modal-edit').on('show.bs.modal', function(e) {
    var obj = $(e.relatedTarget).data('id');
    $("#modalId").val(obj.id);
    $("#modalName").val(obj.name);
    $("#modalEmail").val(obj.email);
    $("#modalGroup").val(obj.enrolls[0].group);
    $("#modalGroupId").val(obj.enrolls[0].id);
    $("#modalSex").val(obj.sex).change();
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
  $( "#users" ).addClass( "active" );
  $( "#students" ).addClass( "active" );
</script>
@endsection