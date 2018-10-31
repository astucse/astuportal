@extends('layouts.admin')

@section('content')
    <h2>Groups</h2>
    <small>Year: {{$current_year}}</small>

<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Pre Engineering</a></li>
              <li><a href="#tab_2" data-toggle="tab">Pre Science</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  SoEEC <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" href="#tab_30" data-toggle="tab">PreSchool</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" href="#tab_31" data-toggle="tab">CSE</a></li>
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
              </li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                A
              </div>
              <div class="tab-pane" id="tab_2">
                 B 
              </div>
              <div class="tab-pane" id="tab_30">
                  D
              </div>
              <div class="tab-pane" id="tab_31">
                @for($i=3;$i<6;$i++)
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Year {{$i}} 
                            <form action="{{route('academic.admin.group.create')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="number" name="year" value="{{$i}}" hidden>
                                <input type="text" name="department" value="CSE" hidden>
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
                        @foreach($groups as $g)
                        @if($g->institution['code'] =="CSE" && $g->batch_year == $i)
                        <tr>
                          <td>{{$g->name}}</td>
                          <td>{{$g->enrollments->count()}} Students</td>
                          <td>
                            <a href="{{route('academic.admin.enroll',['group'=>$g->id])}}" class="badge bg-red">Register</a>
                            <a href="{{route('academic.admin.enroll-detail',['group'=>$g->id])}}" class="badge bg-red">Detail</a>
                        </td>
                        </tr>
                        @endif
                        @endforeach
                      </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                @endfor
              </div>
              <div class="tab-pane" id="tab_32">
                  F
              </div>
              <div class="tab-pane" id="tab_33">
                  F
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
<!--     <div class="nav-tabs-custom">
        @foreach($groups as $y => $gs)
        <div class="nav-tabs-custom">
        	<h3>Year {{$y}}</h3>
        		<div class="tab-content">
                    <table id="StudentsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>A</th>
                            <th>b</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td></td>
                            <td><button type="button" data-id="" class="edit-staff btn btn-default" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
        </div>
        @endforeach
    </div> -->
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