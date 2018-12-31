<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>
AstuPortal: @yield('title')
</title>

  <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">

@yield('css')
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ url('adminlte/css/skins/skin-green.css') }}">



@stack('css-scripts')
</head>


<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="{{route('index')}}" class="logo">
      <span class="logo-mini"><b>A</b>P</span>
      <span class="logo-lg"><b>ASTU</b><small>PORTAL</small></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @if( Auth::user()->isDepartmentHead )
          <li class="user user-menu">
            <a target="_blank" href="{{route('department.index')}}">
              <span class="hidden-xs">Open Department Dashboard</span>
            </a>
          </li>
          @endif
          @if(Auth::user()->isSchoolDean)
          <li class="user user-menu">
            <a target="_blank" href="{{route('school.index')}}">
              <span class="hidden-xs">Open School Dashboard</span>
            </a>
          </li>
          @endif
          <li class="user user-menu">
            <a href="{{route('employee.profile')}}">
              <img src="{{route('employee.image',['id'=>Auth::user()->id])}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar" id="menu">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">

          @if(Auth::user()->isSecretary)
          <li id="secretary" class="treeview">
            <a href="">
              <i class="fa fa-files-o"></i>
              <span>Secretary stuffs</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="secretary-1"><a href="{{route('staffevaluation.secretary.evaluationresults')}}"><i class="fa fa-circle-o"></i>Staff Evaluation Results</a></li>
              <!-- <li id="secretary-2"><a href="dd"><i class="fa fa-circle-o"></i>Employee2</a></li> -->
            </ul>
          </li>
          @endif
        @foreach(Module::collections() as $m)
        @if(null !== config($m->getLowerName().'.employee-routes'))
        @if(sizeof(config($m->getLowerName().'.employee-routes'))>0)
        <li id="{{$m->getLowerName()}}" class="treeview">
          <a href="">
            <i class="fa fa-files-o"></i>
            <span>{{config($m->getLowerName().'.name')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @foreach(config($m->getLowerName().'.employee-routes') as $route )
            <li id="<?=str_replace(' ','',$m->getLowerName().'-'.$route->n)?>"><a href="{{$route->r}}"><i class="fa fa-circle-o"></i>{{$route->n}}</a></li>
            @endforeach
          </ul>
        </li>
        @endif
        @endif
        @endforeach



        <!-- <li id=""><a href=""><i class="fa fa-group"></i> <span> lll</span></a></li> -->
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}" ><i class="fa fa-sign-out"></i><span>Logout</span></a>
        </li>
      </ul>
    </section>
  </aside>




  <div class="content-wrapper">
    @yield('content')
  </div>



</div>
<script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ url('dist/js/adminlte.min.js') }}" type="text/javascript"></script>

 @yield('js')
 @stack('js-scripts')
</body>
</html>
