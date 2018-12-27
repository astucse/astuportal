@extends('layouts.student')


@section('content')
<section class="content-header">
  <h1>
    Profile
    <small></small>
  </h1>
  <ol class="breadcrumb">
  	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Profile</li>
  </ol>
</section>	


<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{route('student.image',['id'=>Auth::user()->id])}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <!-- <p class="text-muted text-center">Software Engineer</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>
              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <div class="col-md-9">
      	<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('student.image.upload')}}">
      		@csrf
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputName" placeholder="Name" value="{{Auth::user()->name}}" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{Auth::user()->email}}" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="inputSkills" class="col-sm-2 control-label">Picture</label>
            <div class="col-sm-10">
              <input type="file"  name="picture" id="inputSkills" >
            </div>
          </div>
          @if(null != Auth::user()->group)
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Group</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="inputEmail" value="{{Auth::user()->group->name}}" disabled>
            </div>
          </div>
          @endif
                  <!-- <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div> -->
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-danger">Submit</button>
            </div>
          </div>
      </form>
  </div>
  </div>
</section>


@endsection