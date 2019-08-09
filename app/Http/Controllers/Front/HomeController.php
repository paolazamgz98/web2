<?php

namespace App\Http\Controllers\Front;

use App\Vehicle;
use App\Category;
use App\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        $locations = Location::all();
        $categories = Category::all();
        return view('front.home', compact('locations', 'categories'));
    }

    public function search(Request $request){
        $picking_location_id = $request->get('picking_location_id');
        $dropping_location_id = $request->get('dropping_location_id');
        $start_from = $request->get('start_from');
        $finish_date = $request->get('finish_date');
        $picking_time = $request->get('picking_time');
        $dropping_time = $request->get('dropping_time');
        $category_id = $request->get('category_id');

        $vehicles = new Vehicle;
        if($request->get('category_id')){
            $vehicles = $vehicles->where('category_id', $request->get('category_id'));
        }
        $vehicles = $vehicles->get();
        return view('front.search', compact('vehicles', 'picking_location_id', 'dropping_location_id', 'start_from', 'finish_date', 'picking_time', 'dropping_time', 'category_id'));
    }

    public function preview(Request $request){
        $pickingLocation= Location::findOrFail($request->get('picking_location_id'));
        $droppingLocation = null;
        if($request->get('dropping_location_id')){
            $droppingLocation = Location::findOrFail($request->get('dropping_location_id'));
        }
        $vehicle = Vehicle::findOrFail($request->get('vehicle_id'));
        $start_from = Carbon::parse($request->get('start_from'));
        $finish_date = Carbon::parse($request->get('finish_date'));
        $days = $finish_date->diffInDays($start_from);
        $hours = $finish_date->diffInHours($start_from);
        if($hours <= 1){
            $hours = 8;
        }else if($hours <= 2){
            $hours = 16;
        }else if($hours <= 24){
            $hours = 24;
        }
        $subtotalWithoutDiscount = $hours * $vehicle->price;
        $promo = intval($hours / 144);
        $discount = 0;
        if($promo >= 1){
            $hours = $hours - ($promo * 24);
            $discount = $promo * 24 * $vehicle->price;
        }
        $amount = $hours * $vehicle->price;
        $airport_fee = 0;
        if($pickingLocation->is_airport){
            $airport_fee = 75.00;
        }
        $different_location_fee = 0;
        if($droppingLocation){
            if($droppingLocation->id != $pickingLocation->id){
                $different_location_fee = 45;
            }
        }
        $total = $amount + $airport_fee + $different_location_fee;

        return view('front.preview', compact('vehicle', 'start_from', 'finish_date', 'promo', 'amount', 'pickingLocation', 'droppingLocation', 'airport_fee', 'different_location_fee', 'total', 'days', 'discount', 'subtotalWithoutDiscount', 'hours'));


    }
}
