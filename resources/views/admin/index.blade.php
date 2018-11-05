@extends('layouts.admin')


@section('content')
@widget('breadcumb',['header'=>'Dashboard','sub-header'=>'Everything about the portal','link0'=>'Home','link9'=>'Dashbord'])


<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>{{$students->count()}}</h3>
      <p>Students</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
    <a href="#" class="small-box-footer">
      More info <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>{{$employees->count()}}</h3>
      <p>Employees</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
    <a href="#" class="small-box-footer">
      More info <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3>24</h3>
      <p>Unique Visitors</p>
    </div>
    <div class="icon">
      <i class="ion ion-pie-graph"></i>
    </div>
    <a href="#" class="small-box-footer">
      More info <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3>147</h3>
      <p>Page Views</p>
    </div>
    <div class="icon">
      <i class="ion ion-pie-graph"></i>
    </div>
    <a href="#" class="small-box-footer">
      More info <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
<!-- ./col -->



<section class="content">
  <div class="row">
    <div class="col-md-6">
      @widget('Chart.pie')
    </div>
    <div class="col-md-6">
      @widget('Chart.pie',['id'=>2])
    </div>
  </div>
</section>






@endsection




@section('js')

@endsection