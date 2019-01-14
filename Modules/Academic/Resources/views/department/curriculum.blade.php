@extends('layouts.department')
@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <section class="content-header">
      <h1>
        Curriculum
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
        <li class=" ">Curriculum</li>
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
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <form method="post" action="{{route('academic.department.coursetocurr')}}">
                            @csrf  
                            <input type="number" hidden name="dep_id" value="{{Auth::user()->myInstitution->id}}">
                            <select name="course_id">
                              @foreach($courses as $in)
                              <option class="select2 form-control" value="{{$in->id}}">{{$in->name}}</option>
                              @endforeach
                            </select>
                            <select name="semester_id">
                              @foreach([3,4,5] as $y)
                                @foreach([1,2] as $s)
                                <option class="select2 form-control" value="{{$y}}-{{$s}}">Year {{$y}} Semester {{$s}}</option>
                                @endforeach
                              @endforeach
                            </select>
                            <button type="submit">Assign</button>
                            </form>
                        </h3>
                    </div>
                    @if(isset($breakdown['schedules']))
                    @if(sizeof($breakdown['schedules'])>0)
                    @foreach($breakdown['schedules'] as $cbd)
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Year {{$cbd['year']}}: Semester {{$cbd['semester']}}
                                </h3>
                            </div>

                            <div class="box-body">
                              <h3>Courses</h3>
                              @foreach($cbd['courses'] as $c)
                                    {{$c->code}} : {{$c->name}} , 
                              @endforeach
                            </div>
                            {{-- dd 
                            <div class="box-body">
                              <h3>Electives</h3>
                              @foreach($cbd['electives'] as $ele)
                                @foreach($ele as $e)
                                  @if(isset($e[0]))
                                    {{$e}} ,
                                  @else
                                    {{$e}} 
                                  @endif
                                  <br>
                                @endforeach
                              @endforeach
                            </div>
                            <div class="box-body">  
                            </div>
                            --}}
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @endif
                </div>
              </div>








          </div>
      </div>



    
@stop



@section('js')
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-Curriculum" ).addClass( "active" );
</script>
<script src="{{url('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>
@endsection