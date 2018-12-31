@extends('layouts.admin')


@section('content')
@widget('breadcumb',['header'=>'Dashboard','sub-header'=>'Everything about the portal','link0'=>'Home','link9'=>'Dashbord'])


<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>{{$stats['students_count']}}</h3>
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
      <h3>{{$stats['employees_count']}}</h3>
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
  <div class="small-box bg-red">
    <div class="inner">
      <h3>?</h3>
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
  <div class="small-box bg-red">
    <div class="inner">
      <h3>?</h3>
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
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Modules</h3>
        </div>
        <div class="box-body no-padding">
          <table class="table table-striped">
            <tr> 
              <th style="width: 10px">#</th>
              <th>Title</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php $module_index =1;?>
            @foreach(Module::all() as $k=>$m)
            <tr>
              <td>{{$module_index}}</td>
              <td>{{$m}}</td>
              <td>
                @if($m->enabled())
                <a class="badge bg-green">Active</a>
                @else
                <a class="badge bg-red">Inactive</a>
                @endif
              </td>
              <td>
                    <a class="btn label label-success" href="{{route('admin.module.status_toggle',['module'=>$m])}}" >Change status</a>
              </td>
            </tr>
            <?php $module_index++;?>
            @endforeach

<!--             <tr>
              <td>2</td><td>Meeting management</td><td><a class="badge bg-green">Active</a></td>
            </tr>
            <tr>
              <td>3</td><td>Staff Evaluation</td><td><a class="badge bg-green">Active</a></td>
            </tr>
            <tr>
              <td>4</td><td>File Sharing</td><td></td>
            </tr> -->
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Sex ratios</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div id="chart-div" class="box-body"></div>
        {!! $lava->render('PieChart', 'STUD_SEX', 'chart-div') !!}
    </div>
  </div>
  <div class="col-md-12">
            <div id="chart-div2" class="box-body"></div>
        {!! $lava->render('BarChart', 'TheBar', 'chart-div2') !!}
  </div>
  <div class="col-md-12">
            <div id="chart-div3" class="box-body"></div>
        {!! $lava->render('BarChart', 'TheBar', 'chart-div3') !!}
  </div>
</section>






@endsection




@section('js')

@endsection