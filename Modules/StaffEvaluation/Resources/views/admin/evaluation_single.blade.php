@extends('layouts.admin')

@section('content')
@widget('breadcumb',['header'=>'Evaluations','sub-header'=>'','link0'=>'Home','link1'=>'Staff Evaluation','link9'=> $evaluation->name,'link2'=>'Evaluations'])
<br>
<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header">
          <i class="fa fa-th"></i>Create Evaluation<b></b></li>
      </ul>
      <div class="tab-content">
        <div class="row">
          <form action="{{route('staffevaluation.admin.question.create')}}" method="POST">
            @csrf
            <input type="number" name="evaluation_id" value="{{$evaluation->id}}" hidden>
          <div class="col-xs-12">
            <div class="form-group">
              <label>English Question</label>
              <input name="english_question" type="text" class="form-control" placeholder="Enter ...">
              </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Amharic Question</label>
              <input name="amharic_question" type="text" class="form-control" placeholder="ጻፍ ...">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Type</label>
              <select class="form-control" name="type">
                <option value="rate">Rate</option>
                <option value="write">Write</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="question_category_id">
                @foreach($categories as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
          </form>
        </div>
      </div>
    </div>

<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> Questions List</li>
      </ul>
      <div class="tab-content">
        <table id="EvaluationTable" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Question Name</th>
            <th>Type</th>
            <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($evaluation->questions as $q)
                            <tr class="">
                <td>{{$q->question_english}} <br> {{$q->question_amharic}} </td>
                <td>{{$q->type}}</td>
                <td> </td>
              </tr>

                  @endforeach
</tbody>
</table>
</div>
</div>

@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Evaluations" ).addClass( "active" );
</script>
@endsection