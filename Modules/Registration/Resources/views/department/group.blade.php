@extends('layouts.department')

@section('content')
@widget('breadcumb',['header'=>'Groups','sub-header'=>'Year: '.$current_year,'link0'=>'Academics','link9'=>'groups'])

<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="#tab_2" data-toggle="tab">Second Year</a></li>
              <li><a href="#tab_3" data-toggle="tab">Third Year</a></li>
              <li><a href="#tab_4" data-toggle="tab">Forth Year</a></li>
              <li><a href="#tab_5" data-toggle="tab">Fifth Year</a></li>
              {{-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> --}}
            </ul>
            <div class="tab-content">
              @foreach ([2,3,4,5] as $y)
                  
              <div class="tab-pane" id="tab_{{$y}}">
                  <div class="box">
                      <div class="box-header">
                          <h3 class="box-title">Year {{$y}}
                            <form action="{{route('registration.department.group.create')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="number" name="year" value="{{$y}}" hidden>
                                <input type="number" name="no" value="1"> Groups
                                <button type="submit" class="btn btn-default">Add</button>
                            </form>
                            
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-striped">
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Detail</th>
                          <th>Actions</th>
                        </tr>
                        @foreach($groups as $yy=>$gs)
                        @if($yy==$y)
                        @foreach($gs as $g)
                        <tr>
                          <td>{{$g->name}}</td>
                          <td>{{$g->enrollments->count()}} Students</td>
                          <td>
                            <a href="{{route('registration.department.enroll',['group'=>$g->id])}}" class="badge bg-red">Register</a>
                            <!-- <a href="{{route('registration.admin.enroll-detail',['group'=>$g->id])}}" class="badge bg-red">Detail</a> -->
                            {{-- <a href="{{route('registration.admin.schedule',['group'=>$g->id])}}" class="badge bg-red">Schedule</a> --}}
                        </td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                      </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                </div>

            @endforeach

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