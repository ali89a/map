@extends('admin.master')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i>Location</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
   
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <form method="post" action="{{ route('locations.store') }}">
  @csrf
      <div class="tile">
        <div class="tile-title">
          <h3 class="float-left">Location Create</h3>
          <a href="{{ route('locations.index') }}" class=" btn btn-primary float-right"><i class="fa fa-th-list"></i>See List</a>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="tile-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Area</label>
                <input class="form-control" name="area" type="text" placeholder="Enter Area">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Latitude</label>
                <input class="form-control" name="latitude" type="text" placeholder="Enter Latitude">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Longitude</label>
                <input class="form-control" name="longitude" type="text" placeholder="Enter Longitude">
              </div>
            </div>
           
          </div>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
        </div>
      </div>
    </form>
  </div>

  <div class="clearix"></div>

</div>
@endsection