@extends('layouts.admin')

@section('content')

<h2>Evaluations</h2>
    
    <?php
    $f = [
    	new App\Widgets\FormField( ['label'=>'Name','name'=>'name', 'category'=>'input', 'type'=>'text','placeholder'=>'Name']),   
    	new App\Widgets\FormField( ['label'=>'Target','name'=>'School', 'category'=>'select', 'type'=>'text', 'placeholder'=>'School', 'children' => [
    		new App\Widgets\FormField( ['name'=>'Student','value'=>'student']),
    		new App\Widgets\FormField( ['name'=>'Collegue','value'=>'collegue']),
    		new App\Widgets\FormField( ['name'=>'Head','value'=>'head']),
    	]])
    ];
    ?>
    @widget('adminCreateForm',['name'=>'Evaluation','action'=>route('staffevaluation.admin.evaluations')],$f )

    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> Evaluations</li>
      </ul>
      <div class="tab-content">
        <table id="AdminsTable" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Evaluation Name</th>
            <th>Target</th>
            <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($evaluations as $eva)
                          <tr class="">
              <td>{{$eva->name}}</td>
              <td>{{$eva->target}}</td>
              <td>
              	<a href="{{route('staffevaluation.admin.evaluation_single',['id'=>$eva->id])}}" class="btn btn-default" ><i class="fa fa-edit"></i> Detail </a> </td>
            </tr>
            @endforeach
                      </tbody>
        </table>
      </div>
    </div>
@stop


@section('js')
<script type="text/javascript"> 
  $( "#staffevaluation" ).addClass( "active" );
  $( "#staffevaluation-Evaluations" ).addClass( "active" );
</script>
@endsection