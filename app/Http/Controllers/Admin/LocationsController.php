<?php

namespace App\Http\Controllers\Admin;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationsController extends Controller
{
    public function index(){
        $locations = Location::all();
        return view('admin.locations.list', compact('locations'));
    }

    public function create(){
        return view('admin.locations.create');
    }

    public function store(Request $request){
        $data = [
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'is_airport' => $request->get('is_airport') ? true : false,
        ];
        $location = Location::create($data);
        return redirect()->route('admin.locations.index');
    }

    public function eliminar($locationId){
        $location = Location::findOrFail($locationId);
        $location->delete();
        return redirect()->route('admin.locations.index');
    }
}
