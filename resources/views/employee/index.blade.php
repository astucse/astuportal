@extends('layouts.employee')


@section('content')
<section class="content-header">
  <h1>
    Dashboard
    <small></small>
  </h1>
  <ol class="breadcrumb">
  	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>	



<section class="content">
		@if(Auth::user()->original_password)
	<div class="alert alert-warning alert-dismissible">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <h4><i class="icon fa fa-ban"></i> Change your Password!</h4>
	    Your  haven't changed your password yet. Please set a new password <a href="{{route('employee.profile')}}"> here</a>.
	  </div>
	  @endif
</section>
@endsection