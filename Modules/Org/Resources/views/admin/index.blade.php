
@extends('layouts.admin')

@section('content')
@widget('breadcumb',['header'=>'Organization','sub-header'=>'','link0'=>'Organization','link9'=>'dashboard'])
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Schools</h3>
        </div>
        <div class="box-body no-padding">
            <table class="table table-striped">
            <tr>
                <th style="width: 10px">#</th>
                <th>Code</th>
                <th>Name</th>
                <th style="width: 40px"></th>
            </tr>
            @foreach ($schools as $id=>$school)  
            <tr>
                <td>{{$id+1}}.</td>
                <td>{{$school->code}}</td>
                <td>{{$school->name}}</td>
                <td></td>
            </tr>
            @endforeach    
        </table>
        </div>
    </div>
    <div class="box">
            <div class="box-header">
                <h3 class="box-title">Departments</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>School</th>
                    <th style="width: 540px">Description</th>
                </tr>
                @foreach ($departments as $id=>$department)  
                <tr>
                    <td>{{$id+1}}.</td>
                    <td>{{$department->code}}</td>
                    <td>{{$department->name}}</td>
                    <td>{{$department->school->name}}</td>
                    <td>{{$department->description}}</td>
                </tr>
                @endforeach    
            </table>
            </div>
        </div>
</section>
    

@stop



@section('js')
<script type="text/javascript">
  $( "#org" ).addClass( "active" );
  $( "#org-Index" ).addClass( "active" );
</script>
@endsection
