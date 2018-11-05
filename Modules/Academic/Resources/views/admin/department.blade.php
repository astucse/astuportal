@extends('layouts.admin')

@section('content')
@widget('breadcumb',['header'=>'Department','sub-header'=>'','link0'=>'Academics','link9'=>'departments'])
    <!-- <h2>Department</h2> -->
    
    <?php
    $d = array();
    foreach ($departments as $department) {
        array_push($d, new App\Widgets\FormField( ['name'=>$department->name,'value'=>$department->id]));
    }
    $f = [   
    	new App\Widgets\FormField( ['label'=>'School','name'=>'School', 'category'=>'select', 'type'=>'text', 'placeholder'=>'School', 'children' => $d]),
    	new App\Widgets\FormField( ['label'=>'Name','name'=>'name', 'category'=>'input', 'type'=>'text','placeholder'=>'Name']),
    	new App\Widgets\FormField( ['label'=>'Code','name'=>'code','category'=>'input','type'=>'text','placeholder'=>'Code']),
    ];
    ?>
    @widget('adminCreateForm',['name'=>'Department','action'=>route('academic.admin.department.post')],$f )

    <div class="nav-tabs-custom">
        <?php
        $t = new App\Widgets\Objects\Table([
            // 'headers' => [['name'=>'language'],['name'=>'one'],['name'=>'two']],
            // 'rows' => [ ['values'=>['oromo','toko','lama']],['values'=>['mite','lame','sase']]],
            'actions' => ['edit']
        ]);
        ?>
        @widget('adminTableList',[ 'name'=>'Group','table'=>$t,'format'=>2, 'model'=>$departments ])
    </div>
@stop



@section('js')
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-Department" ).addClass( "active" );
</script>
@endsection