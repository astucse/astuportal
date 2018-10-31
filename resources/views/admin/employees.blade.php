@extends('layouts.admin')

@section('content')

<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> Students</li>
        <a class="btn btn-primary" href="{{route('admin.employees.export')}}">Export</a>
        <form enctype="multipart/form-data" action="@{{route('admin.super.import', ['type'=>'student'])}}" method="POST">
          {{ csrf_field() }}
          <input type="file" name="zzzz" id="zzzz" class="form-control">
          <button type="submit" class="btn btn-primary">Import</button>
        </form>
      </ul>
      <div class="tab-content">
        <table id="StudentsTable" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Sex</th>
            <th>Initial Password</th>
            <th></th>
            </tr>
          </thead>
          <tbody>
              @foreach($employees as $s)
            <tr class="">
              <td>{{$s->name}}</td>
              <td>{{$s->email}}</td>
              <td>{{$s->sex}}</td>
              <td>{{$s->initial_password}}</td>
              <td>
                <button type="button" data-id="{{$s}}" class="edit-staff btn btn-default" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i>Edit</button>
                <!-- <a href="" class="btn btn-default" ><i class="fa fa-edit"></i> Edit </a>  -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
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
    $('#StudentsTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
<script type="text/javascript">
  $( "#users" ).addClass( "active" );
  $( "#employees" ).addClass( "active" );
</script>
@endsection