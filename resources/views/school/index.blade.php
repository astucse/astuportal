@extends('layouts.school')

@section('content')



<section class="content">

	<div class="box box-solid">
    <div class="box-header with-border">
      <!-- <i class="fa fa-text-width"></i> -->
      <h3 class="box-title">Departments</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
		@foreach($school->departments as $department)
      	<h4>{{$department->code}} : {{$department->name}}</h4>
		@endforeach
    </div>
    <!-- /.box-body -->
  </div>
	
</section>

@stop


@section('js')
<script type="text/javascript"> 
  $( "#index" ).addClass( "active" );
  // $( "#acade.mic-Roles" ).addClass( "active" );
</script>
@endsection