@extends('layouts.department')

@section('content')
@widget('SillyPack',['ckeditor' => true ])

@widget('breadcumb',['header'=>'Staff Evaluation Setting','sub-header'=>'','link0'=>'Home','link9'=>'Staff Evaluation Setting'])

<section class="content"> 
    <div>
      <h2>Reports</h2>
      <p>
        Key:-<br>
        &#60;&#60;Student&#62;&#62; : Student result <br>
        &#60;&#60;Collegue&#62;&#62; : Collegue result <br>
        &#60;&#60;Head&#62;&#62; : Head result <br>
        &#60;&#60;Instructor&#62;&#62; : Instructor Name <br>
      </p>
      <form action="{{route('staffevaluation.department.setting.report.update')}}" method="POST">
        @csrf
      <h3>Good</h3>
      <div id="hey">
        <textarea id="editor1" class="areaa"  rows="12" name="good">{{$reports['good']}}</textarea>
      </div>
      <h3>MEDIUM</h3>
      <div id="hey">
        <textarea id="editor2" class="areaa"  rows="12" name="medium">{{$reports['medium']}}</textarea>
      </div>
      <h3>BAD</h3>
      <div id="hey">
        <textarea id="editor3" class="areaa"  rows="12" name="bad">{{$reports['bad']}}</textarea>
      </div>
      <button class="form-control btn btn-primary" type="submit">Update</button>
      
      </form>
    </div>
</section>

<style type="text/css">
  .areaa{
    width: 100%
  }
</style>

@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Setting" ).addClass( "active" );
</script>
<script>
  $(function () {
    // CKEDITOR.replace('editor1')
    // CKEDITOR.replace('editor2')
    // CKEDITOR.replace('editor3')
    // $('.textarea').wysihtml5()
  })
</script>
@endsection