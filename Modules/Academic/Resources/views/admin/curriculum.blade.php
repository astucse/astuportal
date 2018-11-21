@extends('layouts.admin')
@section('css')
<link href="{{url('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <section class="content-header">
      <h1>
        Curriculum
        <small>
            <div class="btn-group">
                  <button type="button" class="btn btn-default">V{{$curriculum->version}} - {{$curriculum->name}} (Change)</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    @foreach($curriculums as $c)
                    <li><a href="{{route('academic.admin.curriculum_single',['id'=>$c->id])}}">V{{$c->version}} ({{$c->name}})</a></li>
                    @endforeach
                    <li class="divider"></li>
                    <li><a href="#">Create New</a></li>
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
              <li class=""><a data-toggle="tab" href="#tab_1">Pre Engineering</a></li>
              <li><a role="menuitem" href="#tab_10" data-toggle="tab">PreSchool (SoEEC)</a></li>
              <li class="active"><a data-toggle="tab" href="#tab_cse">CSE</a></li>
              <li><a data-toggle="tab" href="#tab_11">ECE</a></li>
              <li><a data-toggle="tab" href="#tab_pce">PCE</a></li>
          </ul>
          <div class="tab-content">
              <div class="tab-pane" id="tab_1">
                 <div class="row">
                    @foreach($coursebreakdown1 as $cbd)
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Year {{$cbd->year}}: Semester {{$cbd->semester}}</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{route('academic.admin.breakdown.course.add')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="number" value="{{$cbd->id}}" name="breakdown_id" hidden>
                                    Course
                                    <br>
                                    <select style="width: 100%" class="form-control select2" name="courses[]" multiple>
                                        @foreach($courses as $e)
                                        <option value="{{$e->id}}" class="form-control">{{$e->code}} : {{$e->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <!-- <input type="text" name="title" class="form-control"> -->
                                    <!-- <br> -->
                                    <button type="submit" class="btn btn-primary">Add</button>
                              </form>
                              @foreach($cbd->Coursess as $c)
                              <li>{{$c->code}} : {{$c->name}}</li>
                              @endforeach

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>
              <div class="tab-pane  " id="tab_10">
                 <div class="row">
                    @foreach($coursebreakdown10 as $cbd)
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Year {{$cbd->year}}: Semester {{$cbd->semester}}</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{route('academic.admin.breakdown.course.add')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="number" value="{{$cbd->id}}" name="breakdown_id" hidden>
                                    Course
                                    <br>
                                    <select style="width: 100%" class="form-control select2" name="courses[]" multiple>
                                        @foreach($courses as $e)
                                        <option value="{{$e->id}}" class="form-control">{{$e->code}} : {{$e->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <!-- <input type="text" name="title" class="form-control"> -->
                                    <!-- <br> -->
                                    <button type="submit" class="btn btn-primary">Add</button>
                              </form>
                              @foreach($cbd->Coursess as $c)
                              <li>{{$c->code}} : {{$c->name}}</li>
                              @endforeach

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>


              <div class="tab-pane  " id="tab_11">
                 <div class="row">
                    @foreach($coursebreakdown_ece as $cbd)
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Year {{$cbd->year}}: Semester {{$cbd->semester}}</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{route('academic.admin.breakdown.course.add')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="number" value="{{$cbd->id}}" name="breakdown_id" hidden>
                                    Course
                                    <br>
                                    <select style="width: 100%" class="form-control select2" name="courses[]" multiple>
                                        @foreach($courses as $e)
                                        <option value="{{$e->id}}" class="form-control">{{$e->code}} : {{$e->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <!-- <input type="text" name="title" class="form-control"> -->
                                    <!-- <br> -->
                                    <button type="submit" class="btn btn-primary">Add</button>
                              </form>
                              @foreach($cbd->Coursess as $c)
                              <li>{{$c->code}} : {{$c->name}}</li>
                              @endforeach

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>
              <div class="tab-pane  active" id="tab_cse">
                 <div class="row">
                    @foreach($coursebreakdown_cse as $cbd)
                    <div class="col-md-12" style="background-color: orange">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Year {{$cbd->year}}: Semester {{$cbd->semester}}</h3>
                            </div>
                            <div class="box-body">
                                <div class="col-md-6">
                                <form action="{{route('academic.admin.breakdown.course.add')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="number" value="{{$cbd->id}}" name="breakdown_id" hidden>
                                    Course
                                    <br>
                                    <select style="width: 100%" class="form-control select2" name="courses[]" multiple>
                                        @foreach($courses as $e)
                                        <option value="{{$e->id}}" class="form-control">{{$e->code}} : {{$e->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <!-- <input type="text" name="title" class="form-control"> -->
                                    <!-- <br> -->
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>
                              </div>
                              <div class="col-md-6">
                              <form action="{{route('academic.admin.breakdown.elective.add')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="number" value="{{$cbd->id}}" name="breakdown_id" hidden>
                                    Courses
                                    <br>
                                    <select style="width: 100%" class="form-control select2" name="courses[]" multiple>
                                        @foreach($courses as $e)
                                        <option value="{{$e->id}}" class="form-control">{{$e->code}} : {{$e->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    Type
                                    <br>
                                    <select style="width: 100%" class="form-control" name="type">
                                        <option value="free" class="form-control">Free</option>
                                        <option value="mandatory" class="form-control">Mandatory</option>
                                        <option value="general" class="form-control">General</option>
                                    </select>
                                    <br>
                                    Cr Hr  <input type="number" name="crhr" >
                                    Choice <input type="number" value="1"  name="options" >
                                    <!-- <input type="text" name="title" class="form-control"> -->
                                    <!-- <br> -->
                                    <button type="submit" class="btn btn-primary">Add</button>
                              </form>
                          </div>
                          <div class="col-md-12">
                            <table class="table table-striped">
                                <tr> 
                                  <th style="width: 10px">#</th>
                                  <th>Code</th>
                                  <th>Name</th>
                                  <th>CrHr</th>
                                  <th></th>
                                </tr>
                                @foreach($cbd->Coursess as $c)
                                <tr>
                                    <td></td>
                                    <td>{{$c->code}}</td>
                                    <td>{{$c->name}}</td>
                                    <td>{{$c->crhr}}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                                @foreach($cbd->Electivess as $e)
                                @if($cbd->Electivess->count() != 0 )
                                <tr>
                                    <td></td>
                                    <td>Elective</td>
                                    <td>
                                      @foreach($e->Coursess as $c)
                                      <li>{{$c->code}} : {{$c->name}}</li>
                                      @endforeach
                                    </td>
                                    <td>
                                      @isset($e->crhr)
                                      {{$e->crhr}}
                                      @endisset
                                    </td>
                                    <td></td>
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                  <td>-</td>
                                  <td>Total Crhr</td>
                                  <td></td>
                                  <td>{{$cbd->TotalCrhr}}</td>
                                </tr>
                            </table>
                          </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>
              <div class="tab-pane  " id="tab_pce">
                 <div class="row">
                    @foreach($coursebreakdown_pce as $cbd)
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Year {{$cbd->year}}: Semester {{$cbd->semester}}</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{route('academic.admin.breakdown.course.add')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="number" value="{{$cbd->id}}" name="breakdown_id" hidden>
                                    Course
                                    <br>
                                    <select style="width: 100%" class="form-control select2" name="courses[]" multiple>
                                        @foreach($courses as $e)
                                        <option value="{{$e->id}}" class="form-control">{{$e->code}} : {{$e->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <!-- <input type="text" name="title" class="form-control"> -->
                                    <!-- <br> -->
                                    <button type="submit" class="btn btn-primary">Add</button>
                              </form>
                              @foreach($cbd->Coursess as $c)
                              <li>{{$c->code}} : {{$c->name}}</li>
                              @endforeach

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>
              <div class="tab-pane" href="#tab_2" id="tab_2">
                B
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