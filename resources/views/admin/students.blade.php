@extends('layouts.admin')

@section('content')

@widget('breadcumb',['header'=>'Students','link0'=>'Home','link1'=>'Users','link9'=>'students'])



<section class="content">
  <div class="nav-tabs-custom">
      <div class="tab-content">
        <!-- <table id="StudentsTable" class="table table-bordered table-striped"> -->
        <!-- </table> -->
        <table id="simple-datatable-example" class="display" style="width:100%">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Id Number</th>
                  <th>Entry Year</th>
                  <th>Sex</th>
                  <th>Action</th>
              </tr>
          </thead>
      </table>
      </div>
    </div>
</section>



<div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Student Info</h4>
          </div>
          <form enctype="multipart/form-data" action="{{route('admin.students.update')}}" method="POST">
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
  $(function () {
    $('#modal-edit').on('show.bs.modal', function(e) {
      var obj = $(e.relatedTarget).data('id');
      $("#modalId").val(obj.id);
      $("#modalName").val(obj.name);
      $("#modalEmail").val(obj.email);
      $("#modalSex").val(obj.sex).change();
      console.log(obj)
    });
  });
</script>
 <script>
        $(document).ready(function() {
            $('#simple-datatable-example').DataTable({
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: "{{ route('admin.students.datatables') }}",
                columns: [
                    { name: 'name' },
                    { name: 'id_number' },
                   // { name: 'action', orderable: false, searchable: false }
                    { name: 'batch_year' },
                    { name: 'sex' },
                    // { name: 'laratablesCustomGroup' },
                    // { name: 'gender' },
                    { name: 'action', orderable: false, searchable: false}
                ],
            });
        });
    </script>
<script type="text/javascript">
  $( "#users" ).addClass( "active" );
  $( "#students" ).addClass( "active" );
</script>
@endsection





@section('js2')


<script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.editor.min.js') }}"></script>
<script>
  
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
  $( "#students" ).addClass( "active" );
</script>
@endsection