@extends('layouts.admin')


@section('content')
Admin

<h2>{{Auth::user()}}</h2>
<a href="{{route('logout')}}">Logout</a>

@endsection