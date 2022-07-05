@extends('admin.master')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-map-marker"></i> Location</h1>
    <!-- <p>Basic bootstrap tables</p> -->
  </div>
  <ul class="app-breadcrumb breadcrumb">

  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title pull-left">Location </h3>
      <div class="pull-right">
        <a href="{{ route('locations.create') }}" class="btn btn-info"><i class="fa fa-plus"></i> Add New</a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead style="background-color: #afe7e9;">
            <tr>
              <th>#</th>
              <th>Area</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>Created At</th>
              <th>Created By</th>
              <th>Updated At</th>
              <th>Updated By</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($locations as $location)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $location->area }}</td>
              <td>{{ $location->latitude }}</td>
              <td>{{ $location->longitude }}</td>
              <td>{{ $location->created_at->diffForHumans() }}</td>
              <td>{{ $location->created_user->name ??'Not Set'  }}</td>
              <td>{{ $location->updated_at->diffForHumans() }}</td>
              <td>{{ $location->updated_user->name ??'Not Set'  }}</td>
              <td>
                <div class="">
                  <a class="btn btn-info btn-sm" href="{{ route('locations.edit', $location->id) }}"><i class="fa fa-lg fa-edit"></i> Edit</a>
                  <form method="POST" action="{{route('locations.destroy', $location->id)}}" class="d-inline">
                    <input type="hidden" name="_method" value="DELETE">
                    @csrf
                    <button data-name="Stationary" type="submit" class="btn btn-danger btn-sm delete-confirm">
                      <i class="fa fa-lg fa-trash"></i>Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection