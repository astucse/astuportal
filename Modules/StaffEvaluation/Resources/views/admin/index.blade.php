@extends('layouts.admin')

@section('content')

@widget('breadcumb',['header'=>'Staff Evaluation Overview ','sub-header'=>'','link0'=>'Home','link9'=>'Staff Evaluation'])



<div class="pad margin no-print">
	<div class="callout callout-info" style="margin-bottom: 0!important;">
	<h4><i class="fa fa-info"></i> Introduction:</h4>
	This module enables students, collegues and department heads to evaluate staff members. Further explanatory notes can be found <a href="#">here</a>.
	</div>
</div>

<section class="content-header">
 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Evaluations</h3>
              <small>Semester 1, Academic year 2011</small>
              <div class="box-tools">
                <!-- <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Instructor Name</th>
                  <th>Course</th>
                  <th>Student Result</th>
                  <th>Collegue Result</th>
                  <th>Supervisor Result</th>
                  <th>Total Result</th>
                  <th></th>
                </tr>
                @foreach($sessions as $session)
                <tr>
                  <td>{{$session->staff->name}}</td>
                  <td>{{$session->course->code}} : {{$session->course->name}}</td>
                  <td>{{$session->results['student']}}</td>
                  <td>{{$session->results['collegue']}}</td>
                  <td>{{$session->results['head']}}</td>
                  <td><b>{{$session->results['all']}}</b></td>
                  <td><a href="{{route('staffevaluation.admin.session_single',['id'=>$session->id])}}">Detail</a></td>
                  <!-- <td><span class="label label-danger">Denied</span></td> -->
                  <!-- <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td> -->
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->


@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Index" ).addClass( "active" );
</script>
@endsection