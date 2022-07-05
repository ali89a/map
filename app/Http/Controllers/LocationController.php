<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::latest()->get();
        return view('admin.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required|unique:locations',
            'longitude' => 'required|unique:locations',
            'latitude' => 'required|unique:locations',
        ]);
        $location = new Location();
        $location->created_by = Auth::id();
        $location->fill($request->all());
        $location->save();

        Toastr::success('Location Created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'area' => 'required|unique:locations,area,' . $location->id,
            'latitude' => 'required|unique:locations,latitude,' . $location->id,
            'longitude' => 'required|unique:locations,longitude,' . $location->id,
        ]);
        $location->updated_by = Auth::id();
        $location->fill($request->all());
        $location->update();
        Toastr::success('Location Updated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        Toastr::success('Location Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('locations.index');
    }

    public function mapMarker()
    {
        $locations = Location::all();
        $map_markes = array();
        foreach ($locations as $key => $location) {
            $map_markes[] = (object)array(
                'area' => $location->area,
                'longitude' => $location->longitude,
                'latitude' => $location->latitude,
            );
        }
        return response()->json($map_markes);
    }
}
