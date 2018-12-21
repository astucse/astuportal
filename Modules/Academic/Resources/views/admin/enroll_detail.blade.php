@extends('layouts.admin')

@section('content')
    <h2>Year: {{$group->batch_year}}, Institution: {{$group->institution->name}}, Group: {{$group->name}}, Enrollments: {{$group->enrollments()->count()}}</h2>
    <div class="box">
            <div class="box-header">
                <h3 class="box-title">Select 
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr> 
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Id</th>
                  <th></th>
                </tr>
                @foreach($group->enrollments as $k=>$e)
                <tr>
                  <td>{{$k+1}}</td>
                  <td>{{$e->student->name}}</td>
                  <td>{{$e->student->id_number}}</td>
                  <td></td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
@stop



@section('js')
<script type="text/javascript"> 
  $( "#academic" ).addClass( "active" );
  $( "#academic-Groups" ).addClass( "active" );
</script>
@endsection


@push('js-scripts')
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
@endpush