@extends('layouts.employee')


@section('content')
<h1>Dashboard</h1>

<h2>{{Auth::user()->roles()->get()}}</h2>

@endsection