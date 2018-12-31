@extends('layouts.department')

@section('content')
@widget('breadcumb',['header'=>'Instructors','sub-header'=>'','link0'=>'Registration','link9'=>'instructors'])

<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th style="width: 10px">#</th>
              <th>Name</th>
              <th></th>
              <th style="width: 40px"></th>
            </tr>
            @foreach($instructors as $k=>$ins)
            <tr>
              <td>{{$k+1}}</td>
              <td>{{$ins->roletaker->name}}</td>
              <td>
              </td>
              <td></td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

@stop



@section('js')
<script type="text/javascript"> 
  $( "#registration" ).addClass( "active" );
  $( "#registration-Instructors" ).addClass( "active" );
</script>
@endsection


@push('js-scripts')

@endpush