	@extends('layouts.employee')


@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection	

@section('content')
@widget('SillyPack',['ckeditor' => true ])
@widget('breadcumb',['header'=>'Edit Letter ','sub-header'=>'','link0'=>'Home','link1'=>'Office Automation','link9'=>'Edit letter'])
<br>

<section class="content">
	<div class="box box-primary">
			<form action="{{route('officeautomation.employee.update_letter')}}" method="POST">
				@csrf
        <input type="hidden" name="letter_id" value="{{$letter->id}}">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Letter</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- <div class="form-group">
                <input class="form-control" placeholder="To:">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Subject:">
              </div> -->
              <div class="form-group">
					<label>Category</label>
                @if($letter->status == "sent")
          <select disabled required name="category" class="form-control">
            @else
          <select required name="category" class="form-control">
            @endif
            @foreach($categories as $c)
            @if($c['code']==$letter->category)
            <option selected value="{{$c['code']}}">{{$c['name']}}</option>
            @else
            <option  value="{{$c['code']}}">{{$c['name']}}</option>
            @endif
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>To</label>
                @if($letter->status == "sent")
          <select disabled required name="to" class="form-control">
            @else
					<select required name="to" class="form-control">
            @endif
            @foreach($offices as $c)
            @if($c->id==$letter->to[0])
            <option selected  value="{{$c->id}}">{{$c->name}}</option>
            @else
						<option  value="{{$c->id}}">{{$c->name}}</option>
            @endif
            @endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Cc</label>
                @if($letter->status == "sent")
          <select disabled multiple name="cc[]"  class="form-control select2">
            @else
					<select multiple name="cc[]"  class="form-control select2">
            @endif
            @foreach($offices as $c)
            @if($letter->cc==null)
              <option  value="{{$c->id}}">{{$c->name}}</option>
            @elseif(Collect($letter->cc)->contains($c->id))
              <option selected value="{{$c->id}}">{{$c->name}}</option>
              @else
  						<option  value="{{$c->id}}">{{$c->name}}</option>
              @endif
						@endforeach
					</select>
				</div>
              <div class="form-group">
                @if($letter->status == "sent")
                    <textarea readonly id="editor1" name="body" class="form-control" style="height: 300px">
                      @else
                    <textarea  id="editor1" name="body" class="form-control" style="height: 300px">
                      @endif
                      <?=$letter->body?>
                    </textarea>
              </div>
<!--               <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div> -->
            <!-- /.box-body -->
            <div class="box-footer">
                @if($letter->status != "sent")
              <div class="pull-right">
                <button type="submit" name="draft" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
              @endif
            </div>
        </form>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
</section>




@stop



@section('js')
<script type="text/javascript">
  $( "#officeautomation" ).addClass( "active" );
  // $( "#officeautomation-Createletter" ).addClass( "active" );
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






@section('js2')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Setting" ).addClass( "active" );
</script>
<script>
  $(function () {
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
    CKEDITOR.replace('editor3')
    // $('.textarea').wysihtml5()
  })
</script>
@endsection