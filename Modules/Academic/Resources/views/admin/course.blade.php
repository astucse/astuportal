@extends('layouts.admin')
@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
@widget('breadcumb',['header'=>'Courses','sub-header'=>'','link0'=>'Academics','link9'=>'courses'])
    <!-- <h2></h2> -->

  <section class="content">
    
<!--       <select class="form-control select2" name="course" id="course">
          @foreach($courses as $e)
          <option value="0"></option>
          <option value="{{$e->id}}">{{$e->code}} : {{$e->name}}</option>
          @endforeach
      </select>
      <select class="form-control select2" name="pre" id="pre">
          @foreach($courses as $e)
          <option value="0"></option>
          <option value="{{$e->id}}">{{$e->code}} : {{$e->name}}</option>
          @endforeach
      </select>
      <button onclick="add_elective()" class="btn btn-default btn-sm">Add</button> -->


        <table id="StudentsTable" class="table table-bordered table-striped">
          <thead>
                <tr> 
                  <th>Name</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Prerequisite</th>
                </tr>
              </thead>
                <tbody>
                @foreach($courses as $k=>$c)
                <tr>
                  <td>{{$c->name}}</td>
                  <td>{{$c->code}}</td>
                  <td>{{$c->description}}</td>
                  <td id="c_{{$c->id}}">
                    @if(isset($c->prerequisite->name))
                    {{$c->prerequisite->code}} : {{$c->prerequisite->name}}
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>
              
  </section>

@stop



@section('js')
<script type="text/javascript"> 
  $( "#academic" ).addClass( "active" );
  $( "#academic-Courses" ).addClass( "active" );
</script>
@endsection


@push('js-scripts')
<script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.editor.min.js') }}"></script>
<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
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
    $('.select2').select2()
  })
</script>
<meta name="_token" content="{!! csrf_token() !!}" />
<script type="text/javascript">
  function add_elective(){
    var c = document.getElementById("course").value;
    var p = document.getElementById("pre").value;
    formData = new FormData();
    formData.append("pre",p);
    formData.append("course",c);
    $.ajax({
        type: "POST",
        url: "{{route('momomo')}}",
        data: formData,
        processData: false,
        contentType:  false,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function (data) {
          alert(data['data']);
          
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
  }
</script>
@endpush