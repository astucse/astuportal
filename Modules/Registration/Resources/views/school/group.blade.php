@extends('layouts.school')

@section('content')
@widget('breadcumb',['header'=>'Groups','sub-header'=>'Year: '.$current_year,'link0'=>'Academics','link9'=>'groups'])

<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_2 active" data-toggle="tab">Second Year</a></li>
  </ul>
  <div class="tab-content">

    
    <div class="tab-pane active" id="tab_2">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Year 2
                  <form action="{{route('registration.department.group.create')}}" method="POST">
                      {{ csrf_field() }}
                      <input type="number" name="year" value="2" hidden>
                      <input type="number" name="no" value="1"> Groups
                      <button type="submit" class="btn btn-default">Add</button>
                  </form>
              </h3>
          </div>
          <div class="box-body no-padding">
            <table class="table table-striped">
              <tr>
                <th style="width: 10px">#</th>
                <th>Detail</th>
                <th>Actions</th>
              </tr>
              @foreach($groups as $g)
              <tr>
                <td>{{$g->name}}</td>
                <td>{{$g->enrollments->count()}} Students</td>
                <td>
                  <a href="{{route('registration.admin.enroll',['group'=>$g->id])}}" class="badge bg-red">Register</a>
                  <a href="{{route('registration.admin.enroll-detail',['group'=>$g->id])}}" class="badge bg-red">Detail</a>
                  {{-- <a href="{{route('registration.admin.schedule',['group'=>$g->id])}}" class="badge bg-red">Schedule</a> --}}
              </td>
              </tr>
              @endforeach
            </table>
          </div>
      </div>
      </div>
</div>

@stop



@section('js')
<script type="text/javascript"> 
  $( "#registration" ).addClass( "active" );
  $( "#registration-Groups" ).addClass( "active" );
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