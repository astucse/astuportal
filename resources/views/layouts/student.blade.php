<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>
Astu Portal: @yield('title')
</title>

  <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">

  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ url('adminlte/css/skins/skin-blue.css') }}">


@yield('css')
@stack('css-scripts')
</head>


<body class="hold-transition skin-blue sidebar-mini">
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
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar" id="menu">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        @foreach(Module::collections() as $m)
        @if(null !== config($m->getLowerName().'.student-routes'))
        @if(sizeof(config($m->getLowerName().'.student-routes'))>0)
        <li id="{{$m->getLowerName()}}" class="treeview">
          <a href="">
            <i class="fa fa-files-o"></i>
            <span>{{config($m->getLowerName().'.name')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @foreach(config($m->getLowerName().'.student-routes') as $route )
            <li id="{{$m->getLowerName()}}-{{$route->n}}"><a href="{{$route->r}}"><i class="fa fa-circle-o"></i>{{$route->n}}</a></li>
            @endforeach
          </ul>
        </li>
        @endif
        @endif
        @endforeach



        <!-- <li id=""><a href=""><i class="fa fa-group"></i> <span> lll</span></a></li> -->
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}" ><i class="fa fa-sign-out"></i><span>Logout</span> {{(Auth::user()->name)}}</a>
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
