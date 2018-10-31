@extends('layouts.admin')

@section('content')
    <h2>Groups</h2>
    <small>Year: {{$current_year}}</small>
    
    <?php
   
    $f = [   
    	// 'batch_year','semester','year','freshman','school','institution'
    	// new App\Widgets\FormField( ['label'=>'','name'=>'School', 'category'=>'select', 'type'=>'text', 'placeholder'=>'School', 'children' => $d]),
    	new App\Widgets\FormField( ['label'=>'Academic year','name'=>'academic_year', 'category'=>'input', 'type'=>'text','value'=>'2011', 'placeholder'=>'2011', 'disabled'=>'true']),
    	new App\Widgets\FormField( ['label'=>'Semester','name'=>'academic_semester', 'category'=>'input', 'type'=>'text','value'=>'1', 'placeholder'=>'1', 'disabled'=>'true']),
    	new App\Widgets\FormField( ['label'=>'Batch Year','name'=>'batch_year', 'category'=>'select', 'children'=>[
    		new App\Widgets\FormField( ['name'=>1,'value'=>1] ),
    		new App\Widgets\FormField( ['name'=>2,'value'=>2]),
    		new App\Widgets\FormField( ['name'=>3,'value'=>3]),
    		new App\Widgets\FormField( ['name'=>4,'value'=>4]),
    		new App\Widgets\FormField( ['name'=>5,'value'=>5]),
    	]]),
    	new App\Widgets\FormField( ['label'=>'Batch Year','name'=>'batch_year', 'category'=>'input']),
    		// new App\Widgets\FormField( ['name'=>1,'value'=>1] ),
    		// new App\Widgets\FormField( ['name'=>2,'value'=>2]),
    		// new App\Widgets\FormField( ['name'=>3,'value'=>3]),
    		// new App\Widgets\FormField( ['name'=>4,'value'=>4]),
    		// new App\Widgets\FormField( ['name'=>5,'value'=>5]),
    	// new App\Widgets\FormField( ['label'=>'Code','name'=>'code','category'=>'input','type'=>'text','placeholder'=>'Code']),
    ];
    ?>
    @widget('adminCreateForm',['name'=>'Group','action'=>route('academic.admin.group.post')],$f )


    <div class="nav-tabs-custom">
        <?php
        $t = new App\Widgets\Objects\Table([
            // 'headers' => [['name'=>'language'],['name'=>'one'],['name'=>'two']],
            // 'rows' => [ ['values'=>['oromo','toko','lama']],['values'=>['mite','lame','sase']]],
            'actions' => ['edit']
        ]);
        ?>
        @foreach($groups as $y => $gs)
        <div class="nav-tabs-custom">
        	<h3>Year {{$y}}</h3>
        		@widget('adminTableList',[ 'name'=>'Group','table'=>$t,'format'=>2, 'model'=>$gs ]) 
        </div>
        @endforeach
    </div>
@stop



@section('js')
<script type="text/javascript"> 
  $( "#academic" ).addClass( "active" );
  $( "#academic-Groups" ).addClass( "active" );
</script>
@endsection