@extends('layouts.employee')

@section('content')

<div class="nav-tabs-custom">
  <ul class="nav nav-tabs pull-right">
    <li class="pull-left header"><i class="fa fa-th"></i>My Evaluation: {{$evaluation->results['all']}}</li>
  </ul>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_00" data-toggle="tab">Overview</a></li>
    <li ><a href="#tab_0" data-toggle="tab">Students</a></li>
    <li><a href="#tab_1" data-toggle="tab">Collegue</a></li>
    <li><a href="#tab_2" data-toggle="tab">Head</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_00">
      <?php $i=1 ;?>
      @foreach($evaluation->resultByCategory as $e=>$ee)
      @widget('Chart.bar',[
          'type' => 'plotly',
          'id' => $i,
          'header' => $e,
          'data' =>'['.implode(",",Collect($evaluation->resultByCategory[$e])->pluck('result')->toArray()).']',
          'labels' => '['.implode(",",Collect($evaluation->resultByCategory[$e])->pluck('name')->toArray()).']'
      ])
      <?php $i++; ?>
      @endforeach
    </div>
    <div class="tab-pane" id="tab_0">
      Average: {{$evaluation->results['student']}}<br>
      Evaluators: {{$evaluation->answered_students->count()}}<br>
      <br>
    <table id="Table1" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th width="50%">Question</th>
            <th width="10%">Category</th>
            <th>Result</th>
            </tr>
          </thead>
          <tbody>
            @foreach($evaluation->student_answers as $question_category=>$ansrows)
            @foreach($ansrows as $k=>$ans)
            @if($ans->first()->write_answer)
            <tr>
              <td>{{$ans->first()->question->question_amharic}}</td>
              <td>{{$categories->where('id', $question_category)->first()->name}}</td>
              <td>
                @foreach($ans as $a)
                {{$a->write_answer}}<br>
                @endforeach
              </td>
            </tr>
            @else
            @if($ans->avg('rate_answer')<3)
            <tr style="background: #f7a1a1">
            @elseif($ans->avg('rate_answer')>=4)
            <tr style="background: #a1f7aa">
            @endif
              <td>{{$ans->first()->question->question_amharic}}</td>
              <td>{{$categories->where('id', $question_category)->first()->name}}</td>
              <td>{{$ans->avg('rate_answer')}}</td>
            </tr>
            @endif
            @endforeach
            @endforeach
          </tbody>
        </table>
  </div>



  <div class="tab-pane" id="tab_1">
      Average: {{$evaluation->results['collegue']}}<br>
      Evaluators: {{$evaluation->answered_collegues->count()}}<br>
      <br>
    <table id="Table2" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th width="50%">Question</th>
            <th width="10%">Category</th>
            <th>Result</th>
            </tr>
          </thead>
          <tbody>
            @foreach($evaluation->collegue_answers as $question_category=>$ansrows)
            @foreach($ansrows as $k=>$ans)
            @if($ans->first()->write_answer)
            <tr>
              <td>{{$ans->first()->question->question_english}}</td>
              <td>{{$categories->where('id', $question_category)->first()->name}}</td>
              <td>
                @foreach($ans as $a)
                {{$a->write_answer}}<br>
                @endforeach
              </td>
            </tr>
            @else
            @if($ans->avg('rate_answer')<3)
            <tr style="background: #f7a1a1">
            @elseif($ans->avg('rate_answer')>=4)
            <tr style="background: #a1f7aa">
            @endif
              <td>{{$ans->first()->question->question_english}}</td>
              <td>{{$categories->where('id', $question_category)->first()->name}}</td>
              <td>{{$ans->avg('rate_answer')}}</td>
            </tr>
            @endif
            @endforeach
            @endforeach
          </tbody>
        </table>
  </div>
  




  <div class="tab-pane" id="tab_2">
      Average: {{$evaluation->results['head']}}<br>
      Evaluators: {{$evaluation->answered_heads->count()}}<br>
      <br>
    <table id="Table3" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th width="50%">Question</th>
            <th width="10%">Category</th>
            <th>Result</th>
            </tr>
          </thead>
          <tbody>
            @foreach($evaluation->head_answers as $question_category=>$ansrows)
            @foreach($ansrows as $k=>$ans)
            @if($ans->first()->write_answer)
            <tr>
              <td>{{$ans->first()->question->question_english}}</td>
              <td>{{$categories->where('id', $question_category)->first()->name}}</td>
              <td>
                @foreach($ans as $a)
                {{$a->write_answer}}<br>
                @endforeach
              </td>
            </tr>
            @else
            @if($ans->avg('rate_answer')<3)
            <tr style="background: #f7a1a1">
            @elseif($ans->avg('rate_answer')>=4)
            <tr style="background: #a1f7aa">
            @endif
              <td>{{$ans->first()->question->question_english}}</td>
              <td>{{$categories->where('id', $question_category)->first()->name}}</td>
              <td>{{$ans->avg('rate_answer')}}</td>
            </tr>
            @endif
            @endforeach
            @endforeach
          </tbody>
        </table>
  </div>

</div>
</div>


@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-MyEvaluations" ).addClass( "active" );
</script>
<script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- <script src="{{ url('adminlte/plugins/datatables/dataTables.buttons.min.js') }}"></script> -->
<script src="{{ url('adminlte/plugins/datatables/dataTables.select.min.js') }}"></script>
<!-- <script src="{{ url('adminlte/plugins/datatables/dataTables.editor.min.js') }}"></script> -->
<script>
  $(function () {
    $('#Table1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    })
    $('#Table2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    })
    $('#Table3').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    })
  })
</script>
@endsection