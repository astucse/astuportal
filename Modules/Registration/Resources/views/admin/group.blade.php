@extends('layouts.admin')

@section('content')
@widget('breadcumb',['header'=>'Groups','sub-header'=>'Year: '.$current_year,'link0'=>'Academics','link9'=>'groups'])

<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Pre Engineering</a></li>
              <li><a href="#tab_2" data-toggle="tab">Pre Science</a></li>
              {{-- <li class="dropdown active">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  SoEEC <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" href="#tab_30" data-toggle="tab">PreSchool</a></li>
                  <li role="presentation" class="divider"></li>
                  <li class="active" role="presentation"><a role="menuitem" href="#tab_31" data-toggle="tab">CSE</a></li>
                  <li role="presentation"><a role="menuitem" href="#tab_32" data-toggle="tab">ECE</a></li>
                  <li role="presentation"><a role="menuitem" href="#tab_33" data-toggle="tab">PCE</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  SoMMCE <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">PreSchool</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSE</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">PCE</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  SoCEA <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">PreSchool</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSE</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">PCE</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  SoANS <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSE</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">PCE</a></li>
                </ul>
              </li> --}}
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Year 1
                            <form action="{{route('registration.admin.group.create')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="number" name="year" value="1" hidden>
                                <input type="text" name="department" value="preengineering" hidden>
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
                        @foreach($group_preengineering as $g)
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
                    <!-- /.box-body -->
                </div>
                
              </div>
              <div class="tab-pane" id="tab_2">
                    <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Year 1
                                    <form action="{{route('registration.admin.group.create')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="number" name="year" value="1" hidden>
                                        <input type="text" name="department" value="prescience" hidden>
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
                                @foreach($group_prescience as $g)
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
                            <!-- /.box-body -->
                        </div>
              </div>
            </div>
            <!-- /.tab-content -->
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