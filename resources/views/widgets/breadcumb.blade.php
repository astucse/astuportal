<section class="content-header">
  <h1>
    {{$config['header']}}
    @if($config['sub-header']!="?")
    <small><?=$config['sub-header']?></small>
    @endif
  </h1>
  <ol class="breadcrumb">
  	@if($config['link0']!="?")
    <li><a href="#"><i class="{{$config['icon']}}"></i> {{$config['link0']}}</a></li>
    @endif
    @if($config['link1']!="?")
    <li><a href="#">{{$config['link1']}}</a></li>
    @endif
    @if($config['link2']!="?")
    <li><a href="#">{{$config['link2']}}</a></li>
    @endif
    @if($config['link3']!="?")
    <li><a href="#">{{$config['link3']}}</a></li>
    @endif
    @if($config['link9']!="?")
    <li class="active">{{$config['link9']}}</li>
    @endif
  </ol>
</section>