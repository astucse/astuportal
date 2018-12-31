
@extends('layouts.admin')

@section('content')
@widget('breadcumb',['header'=>'Office','sub-header'=>'','link0'=>'Organization','link9'=>'office'])
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Create</h3>
        </div>
        <div class="box-body no-padding">
            <table class="table table-striped">
            <tr>
                {{-- <th style="width: 10px">#</th> --}}
                {{-- <th>Code</th> --}}
                <th colspan="4">Office of Department</th>
                {{-- <th style="width: 40px"></th> --}}
            </tr>
            <tr>
                <td></td>
                <td>Office of School</td>
                <td>
                    <form enctype="multipart/form-data" action="{{route('org.admin.office.create')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-8">
                            <input type="text" name="institution_type" value="school" hidden>
                        <select class="form-control" name="institution_id" data-placeholder="School">
                        @foreach($schools as $s)
                        <option value="{{$s->id}}">{{$s->name}}</option>
                        @endforeach
                        </select>  
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-primary">Create</button>
                    </div>
                </form>
                </td>
            </tr>   
            <tr>
                <td></td>
                <td>Office of Department</td>
                <td>
                    <form enctype="multipart/form-data" action="{{route('org.admin.office.create')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-8">
                            <input type="text" name="institution_type" value="department" hidden>
                            <select class="form-control select2" name="institution_id" data-placeholder="Select from Staff">
                        @foreach($departments as $s)
                        <option value="{{$s->id}}">{{$s->name}}</option>
                        @endforeach
                        </select>  
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-primary">Create</button>
                    </div>
                </form>
                </td>
            </tr> 
            <tr>
                <td></td>
                <td>Other Office</td>
                <td>
                    <form enctype="multipart/form-data" action="{{route('org.admin.office.create')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-8">
                        <input type="text" name="institution_type" value="other" hidden>
                        <input type="text" required class="form-control" name="institution_name">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-primary">Create</button>
                    </div>
                </form>
                </td>
            </tr>    
        </table>
        </div>
    </div>
    <div class="box">
            <div class="box-header">
                <h3 class="box-title">List</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    {{-- <th>School</th> --}}
                    {{-- <th style="width: 540px">Description</th> --}}
                </tr>
                @foreach ($offices as $id=>$office)  
                <tr>
                    <td>{{$id+1}}.</td>
                    <td>{{$office->name}}</td>
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
  $( "#org-Office" ).addClass( "active" );
</script>
@endsection
