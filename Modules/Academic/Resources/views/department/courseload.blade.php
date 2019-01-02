@extends('layouts.department')
@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <section class="content-header">
      <h1>
        Courseload
        <small>
            <div class="btn-group">
                  <!-- <button type="button" class="btn btn-default">V{{$curriculum->version}} - {{$curriculum->name}} (Change)</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button> -->
                  <ul class="dropdown-menu" role="menu">
                    <!-- <li class="divider"></li> -->
                    <!-- <li><a href="#">Create New</a></li> -->
                  </ul>
              </div>
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Academics</a></li>
        <li class=" ">Courseload</li>
      </ol>
    </section>

    <!-- <a class="btn btn-primary" href="{{route('academic.admin.course.export')}}">Export</a> -->
    <!-- <a class="btn btn-primary" href="{{route('academic.admin.course.export')}}">New Curriculum</a> -->
    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab_1">All</a></li>
          </ul>
          <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                 <div class="row">
                    @foreach($breakdown['schedules'] as $cbd)
                    @if($current_semester == $cbd['semester'])
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Year {{$cbd['year']}}: Semester {{$cbd['semester']}}</h3>
                            </div>
                            <div class="box-body">
                              @foreach($cbd['all'] as $c)
                              <li>
                                <form method="post" action="{{route('academic.department.instructors.assign')}}">
                                @csrf  
                                <input type="hidden" name="year" value="{{$cbd['year']}}">
                                <input type="hidden" name="course_id" value="{{$c->id}}">
                                {{$c->code}} : {{$c->name}}
                                <select name="instructor_id">
                                @foreach($instructors as $in)
                                <option value="{{$in->roletaker->id}}">{{$in->roletaker->name}}</option>
                                @endforeach
                                </select>
                                <button>Assign</button>
                                </form>
                                @foreach(collect($assigned)->where('batch_year',$cbd['year'])->where('course_id',$c->id)   as $a )
                                <b> {{$a->instructor->name}}</b> , 
                                @endforeach
                              </li>
                              @endforeach
                            </div>
                            <div class="box-body">  
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
              </div>








          </div>
      </div>



    
@stop



@section('js')
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-Courseload" ).addClass( "active" );
</script>
<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>
@endsection