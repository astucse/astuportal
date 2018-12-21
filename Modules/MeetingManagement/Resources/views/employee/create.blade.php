@extends('layouts.employee')

@section('content')
<?php
    $f = [   
        new App\Widgets\FormField( ['label'=>'Name','name'=>'name', 'category'=>'input', 'type'=>'text', 'placeholder'=>'Name'])
    ];
    ?>
    @widget('adminCreateForm',['name'=>'Group','action'=>route('meetingmanagement.employee.create.post')],$f )
@stop



@section('js')
<script type="text/javascript">
  $( "#meetingmanagement" ).addClass( "active" );
  $( "#meetingmanagement-Create" ).addClass( "active" );
</script>
@endsection