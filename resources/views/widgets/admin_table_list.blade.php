
      <div class="tab-content">
        <table id="StudentsTable" class="table table-bordered table-striped">

        	@if($config['format']==1)
          <thead>
            <tr>
            	@foreach($config['table']->headers as $h)
            	<th>{{$h['name']}}</th>
            	@endforeach
            	@if(isset($config['table']->actions) && sizeof($config['table']->actions) > 0 )
            	<th>Actions</th>
            	@endif
            </tr>
          </thead>
          <tbody>
          	@foreach($config['table']->rows as $r)
            <tr class="">
            	@foreach($r['values'] as $rv)
            	<td>{{$rv}}</td>
            	@endforeach
            	@if(isset($config['table']->actions) && sizeof($config['table']->actions) >0 )
            	<td>
            	@foreach($config['table']->actions as  $action)
            	<button type="button" data-id="" class="edit-staff btn btn-default" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i>{{$action}}</button>
            	@endforeach
            	</td>
            	@endif
            </tr>
            @endforeach
          </tbody>
          @elseif($config['format']==2)
          <thead>
            <tr>
            	@foreach($config['table']->table_attributes as $h)
            	<th>{{$h}}</th>
            	@endforeach
            	@if(isset($config['table']->actions) && sizeof($config['table']->actions) > 0 )
            	<th>Actions</th>
            	@endif
            </tr>
          </thead>
          <tbody>
          	@foreach($config['model'] as $m)
            <tr class="">
            	@foreach($config['table']->table_attribute_relations as $rv)
              <?php
              $erv = explode('.', $rv);
              $rvv = $m;
              for ($i=0; $i < sizeof($erv); $i++) {
                if(isset($rvv->{$erv[$i]}))
                  $rvv = $rvv->{$erv[$i]};
                else
                  $rvv = "-";
              }
              if($rvv === true){
                $rvv = "true";
              }else if($rvv === false){
                $rvv = "false";
              }
              ?>
            	<td>{{$rvv }}</td>
            	@endforeach
            	@if(isset($config['table']->actions) && sizeof($config['table']->actions) >0 )
            	<td>
            	@foreach($config['table']->actions as  $action)
              <a type="button" class="edit-staff btn btn-default"><i class="fa fa-edit"></i>{{$action}}</a>
            	<!-- <button type="button" data-id="" class="edit-staff btn btn-default" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i>{{$action}}</button> -->
            	@endforeach
            	</td>
            	@endif
            </tr>
            @endforeach
          </tbody>
          @endif


        </table>
      </div>
    

    <!-- <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Student Info</h4>
          </div>
          <form enctype="multipart/form-data" action="" method="POST">
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
    </div> -->
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
      'paging'      : <?=$config['paging']?>,
      'lengthChange': <?=$config['lengthChange']?>,
      'searching'   : <?=$config['searching']?>,
      'ordering'    : <?=$config['ordering']?>,
      'info'        : <?=$config['info']?>,
      'autoWidth'   : <?=$config['autoWidth']?>
    })
  })
</script>
@endpush