	@extends('layouts.employee')


@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection	

@section('content')
@widget('SillyPack',['ckeditor' => true ])
@widget('breadcumb',['header'=>'Create Letter ','sub-header'=>'','link0'=>'Home','link1'=>'Office Automation','link9'=>'Create letter'])
<br>


<section class="content">
	<div class="box-header with-border">
		<h3 class="box-title">Outbox</h3>
		<div class="box-tools pull-right">
			<div class="has-feedback">
				<input type="text" class="form-control input-sm" placeholder="Search Mail">
				<span class="glyphicon glyphicon-search form-control-feedback"></span>
			</div>
		</div>
	</div>
	<div class="box-body no-padding">
		<div class="mailbox-controls">
			<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
			<div class="btn-group">
				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
			</div>
			<button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
			<div class="pull-right">1-50/200<div class="btn-group">
				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
				<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
			</div>
		</div>
	</div>
	<div class="table-responsive mailbox-messages">
		<table class="table table-hover table-striped">
			<tbody>
				@foreach($letters as $letter)
                  <tr>
                    <td><input type="checkbox"></td>
                    @if($letter->status == "sent")
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    @else
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                    @endif
                    <td class="mailbox-name">
                    	<a href="{{route('officeautomation.employee.single_letter',['id'=>$letter->hashedId])}}">
                    		@foreach($letter->recipietents as $r)
                    		{{$r->name}}
                    		@endforeach
                    	</a>
                	</td>
                    <td class="mailbox-subject">
                    	<?=substr($letter->body, 0,14) ?> ...
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">
                    {{$letter->updated_at->diffForHumans()}}
                	</td>
                  </tr>
                  @endforeach
                  

                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
</section>
	
@stop



@section('js')
<script type="text/javascript">
  $( "#officeautomation" ).addClass( "active" );
  $( "#officeautomation-Outboxletters" ).addClass( "active" );
</script>
<script>
  $(function () {
    CKEDITOR.replace('editor1')
  })
</script>

<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $('.select2').select2()
    $('#EvaluationTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
  $('#level').on('change', function() {
    // alert( this.value );
    $("#theSelect option:selected").attr('disabled','disabled').siblings().removeAttr('disabled');
  });
</script>
@endsection



