@extends('layouts.admin')

@section('content')
@widget('breadcumb',['header'=>'Evaluation Forms','sub-header'=>'','link0'=>'Home','link1'=>'Staff Evaluation','link9'=>'Evaluations'])
<br>    
    <?php
    $f = [
    	new App\Widgets\FormField( ['label'=>'Name','name'=>'name', 'category'=>'input', 'type'=>'text','placeholder'=>'Name']),   
    	new App\Widgets\FormField( ['label'=>'Target','name'=>'target', 'category'=>'select', 'type'=>'text', 'placeholder'=>'School', 'children' => [
    		new App\Widgets\FormField( ['name'=>'Student','value'=>'student']),
    		new App\Widgets\FormField( ['name'=>'Collegue','value'=>'collegue']),
    		new App\Widgets\FormField( ['name'=>'Head','value'=>'head']),
    	]])
    ];
    ?>
    @widget('adminCreateForm',['name'=>'Evaluation Forms','action'=>route('staffevaluation.admin.evaluations.create')],$f )

    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="pull-left header"><i class="fa fa-th"></i> Evaluation Forms</li>
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
  $( "#staffevaluation-EvaluationForms" ).addClass( "active" );
</script>
@endsection