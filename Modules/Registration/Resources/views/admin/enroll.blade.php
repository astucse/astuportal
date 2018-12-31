@extends('layouts.admin')

@section('content')
@widget('breadcumb',['header'=>'Enroll','link0'=>'Home','link1'=>'Academic','link2'=>'Group','link9'=>'enroll'])
<section class="content">

    <h3>Year: {{$group->batch_year}}, Institution: 
        @if ($group->preengineering)
            Preengineering, 
        @elseif($group->prescience)
            Prescience,
        @elseif($group->institution)
            {{$group->institution->name}}, 
        @endif
        Group: {{$group->name}}, Total Students: {{$group->enrollments()->count()}}</h3>
    <div class="box">
            <div class="box-header">
                <h3 class="box-title">Select 
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <form action="{{route('academic.admin.enroll.post')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="number" name="group_id" value="{{$group->id}}" hidden>
              <table class="table table-striped">
                <tr> 
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Id</th>
                  <th>Year</th>
                </tr>
                @foreach($students as $s)
                <tr>
                  <td><input name="students[]" value="{{$s->id}}" id="students" type="checkbox" ></td>
                  <td>{{$s->name}}</td>
                  <td>{{$s->id_number}}</td>
                  <td>{{$s->batch_year}}</td>
                </tr>
                @endforeach
              </table>
              <button type="submit" class="form-control btn btn-primary">Submit</button>
               </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


    </section>
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