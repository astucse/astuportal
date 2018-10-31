@extends('layouts.employee')
@section('css')
<link href="{{ url('adminlte/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <h3>
        <li class="pull-left header"><i class="fa fa-th"></i> 
        Instructor: {{$evaluationsession->staff->name}} <br>
        </li>
        <li class="pull-left header"><i class="fa fa-th"></i> 
        Year: {{$evaluationsession->academic_year}}<br>
        </li>
        <li class="pull-left header"><i class="fa fa-th"></i> 
        Semester: {{$evaluationsession->semester}} <br>
        <li class="pull-left header"><i class="fa fa-th"></i> 
        Course Title: {{$evaluationsession->course->name}} <br>
        <li class="pull-left header"><i class="fa fa-th"></i> 
        Course code: {{$evaluationsession->course->code}} <br>
        </h3>
      </li>
      </ul>
      <div class="tab-content">
        <div class="row">
          <form action="{{route('staffevaluation.collegue.evaluate') }}" method="POST">
          {{ csrf_field() }}
          <input type="number" name="evaluationsession_id" value="{{$evaluationsession->id}}" hidden>
          <input type="number" name="evaluation_id" value="{{$evaluationsession->collegue_evaluation->id}}" hidden>
          <input type="number" name="user_id" value="{{Auth::user()->id}}" hidden>
          @foreach($evaluationsession->collegue_evaluation->questions as $eeq)
          @if($eeq->type == "rate")
          <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active">
              <h4 class="widget-user-username">{{$eeq->question_english}}</h4>
              <h5 class="widget-user-desc">{{$eeq->category->name}}</h5>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-2 border-right">
                  <div class="description-block">
                    <input required type="radio" name="question{{$eeq->id}}" id="optionsRadios{{$eeq->id}}" value="1" >  
                    <h5 class="description-header"><i class="fa fa-star"></i></h5>
                    <span class="description-text">Very low / በጣም ዝቅተኛ</span>
                  </div>
                </div>
                <div class="col-sm-2 border-right">
                  <div class="description-block">
                    <input type="radio" name="question{{$eeq->id}}" id="optionsRadios{{$eeq->id}}" value="2" >
                    <h5 class="description-header"><i class="fa fa-star"></i><i class="fa fa-star"></i></h5>
                    <span class="description-text">Low / ዝቅተኛ</span>
                  </div>
                </div>
                <div class="col-sm-2 border-right">
                  <div class="description-block">
                    <input type="radio" name="question{{$eeq->id}}" id="optionsRadios{{$eeq->id}}" value="3" checked>
                    <h5 class="description-header"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></h5>
                    <span class="description-text"> Medium / መካከለኛ</span>
                  </div>
                </div>
                <div class="col-sm-2 border-right">
                  <div class="description-block">
                    <input type="radio" name="question{{$eeq->id}}" id="optionsRadios{{$eeq->id}}" value="4" >
                    <h5 class="description-header"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></h5>
                    <span class="description-text">High /  ከፍተኛ</span>
                  </div>
                </div>
                <div class="col-sm-2 border-right">
                  <div class="description-block">
                    <input type="radio" name="question{{$eeq->id}}" id="optionsRadios{{$eeq->id}}" value="5" >
                    <h5 class="description-header"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></h5>
                    <span class="description-text">Very High / በጣም ከፍተኛ</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @else
        <div class="box box-widget widget-user">
          <div class="widget-user-header bg-aqua-active">
            <h3 class="widget-user-username">{{$eeq->question_english}}</h3>
            <h5 class="widget-user-desc"></h5>
          </div>
          <div class="box-footer">
            <textarea rows="5" required type="text" name="question{{$eeq->id}}" class="form-control" required></textarea>
          </div>
        </div>
        @endif

      @endforeach
      <div class="col-xs-12 ">
        <br>
        <button class="btn btn-primary form-control">Finish</button>
      </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>


@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Evaluations" ).addClass( "active" );
</script>
@endsection