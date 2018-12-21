@extends('layouts.admin')


@section('content')

<h2>Hello from the @{{Module::collections()}} other sides</h2>

@endsection



@section('js')
<script type="text/javascript">
  $( "#academic" ).addClass( "active" );
  $( "#academic-index" ).addClass( "active" );
</script>
@endsection