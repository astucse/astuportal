
@extends('layouts.admin')

@section('content')
    <h2>Schools</h2>
    
    <?php
    $f = [   
        new App\Widgets\FormField( ['label'=>'Name','name'=>'name', 'category'=>'input', 'type'=>'text','placeholder'=>'Name']),
        new App\Widgets\FormField( ['label'=>'Code','name'=>'code','category'=>'input','type'=>'text','placeholder'=>'Code']),
    ];
    ?>
    @widget('adminCreateForm',['name'=>'School','action'=>route('academic.admin.school.post')],$f )

    <div class="nav-tabs-custom">
        <?php
        $t = new App\Widgets\Objects\Table([
            // 'headers' => [['name'=>'language'],['name'=>'one'],['name'=>'two']],
            // 'rows' => [ ['values'=>['oromo','toko','lama']],['values'=>['mite','lame','sase']]],
            'actions' => ['edit']
        ]);
        ?>
        @widget('adminTableList',[ 'name'=>'Group','table'=>$t,'format'=>2, 'model'=>$schools ])
    </div>
@stop



@section('js')
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-School" ).addClass( "active" );
</script>
@endsection



@section('js2')
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-School" ).addClass( "active" );
</script>
@endsection