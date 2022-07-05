@extends('admin.master')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
   
  </ul>
</div>
<div class="row">
  <div class="col-md-6 col-lg-3">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Users</h4>
        <p><b>{{ $users }}</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-map-marker fa-3x"></i>
      <div class="info">
        <h4>Locations</h4>
        <p><b>{{ $locations }}</b></p>
      </div>
    </div>
  </div>
</div>

@endsection