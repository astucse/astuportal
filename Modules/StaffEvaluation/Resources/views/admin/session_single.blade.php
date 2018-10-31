@extends('layouts.admin')
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
        </li>
        <li class="pull-left header"><i class="fa fa-th"> </i>
        Course Title: {{$evaluationsession->course->name}} <br>
        </li>
        <li class="pull-left header"><i class="fa fa-th"></i> 
        Course code: {{$evaluationsession->course->code}} <br>
        </li>
        <li class="pull-left header"><i class="fa fa-th"></i>
        Status: @if($evaluationsession->active) <b style="color: blue">Active</b>  @else Not active @endif<br>
        </li>
        </h3>
      </ul>
      <div class="tab-content">

<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="#tab_1" data-toggle="tab">General</a></li>
              <li><a href="#tab_2" data-toggle="tab">Collegues</a></li>
              <li><a href="#tab_3" data-toggle="tab">Heads</a></li>
              <li class="active"><a href="#tab_4" data-toggle="tab">Students</a></li>
              <!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <h3>Overview</h3>
                Evaluated Students :  {{sizeof($evaluated['students'])}} / {{sizeof($evaluated['students']) + sizeof($notevaluated['students']) }} <br>
                Evaluated Collegues :  {{sizeof($evaluated['collegues'])}} / {{sizeof($evaluated['collegues']) + sizeof($notevaluated['collegues'])}}<br>
                Evaluated Heads :  {{sizeof($evaluated['heads'])}} / {{sizeof($evaluated['heads']) + sizeof($notevaluated['heads'])}}


                <h3>Result</h3>
                All {{$result['all']}}<br>
                Student {{$result['student']}}<br>
                Collegue {{$result['collegue']}}<br>
                Head {{$result['head']}}<br>



              </div>
              <div class="tab-pane" id="tab_2">
        <h2>Not Evaluated</h2>
          <table class="table table-bordered table-striped">
          <thead>
            <tr>
            <th></th>
            <th>Name</th>
            <th>Group</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notevaluated['collegues'] as $stu)
            <tr class="">
              <td>{{$stu->name}}</td>
              <td></td>
              <td>
                <!-- <a href="" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a>  -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <h2>Evaluated</h2>
          <table class="table table-bordered table-striped">
          <thead>
            <tr>
            <th></th>
            <th>Name</th>
            <th>Group</th>
            </tr>
          </thead>
          <tbody>
            @foreach($evaluated['collegues'] as $stu)
            <tr class="">
              <td>{{$stu->name}}</td>
              <td></td>
              <td>
                <!-- <a href="" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a>  -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
              <div class="tab-pane" id="tab_3">
        <h2>Not Evaluated</h2>
          <table class="table table-bordered table-striped">
          <thead>
            <tr>
            <th></th>
            <th>Name</th>
            <th>Group</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notevaluated['heads'] as $stu)
            <tr class="">
              <td>{{$stu->name}}</td>
              <td></td>
              <td>
                <!-- <a href="" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a>  -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <h2>Evaluated</h2>
          <table class="table table-bordered table-striped">
          <thead>
            <tr>
            <th></th>
            <th>Name</th>
            <th>Group</th>
            </tr>
          </thead>
          <tbody>
            @foreach($evaluated['heads'] as $stu)
            <tr class="">
              <td>{{$stu->name}}</td>
              <td></td>
              <td>
                <!-- <a href="" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a>  -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        <div class="tab-pane" id="tab_4">
          <h2>Not Evaluated</h2>
          <table class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Name</th>
            <th>Group</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notevaluated['students'] as $stu)
            <tr class="">
              <td>{{$stu->name}}</td>
              <td>{{$stu->group->name}}</td>
              <td>
                <!-- <a href="" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a>  -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <h2>Evaluated</h2>
          <table class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Name</th>
            <th>Group</th>
            </tr>
          </thead>
          <tbody>
            @foreach($evaluated['students'] as $stu)
            <tr class="">
              <td>{{$stu->name}}</td>
              <td>{{$stu->group->name}}</td>
              <td>
                <!-- <a href="" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a>  -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      </div>
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