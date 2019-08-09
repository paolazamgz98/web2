<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingsController extends Controller
{
    public function index(){
        $bookings = Booking::all();
        return view('admin.bookings.list', compact('bookings'));
    }

    public function show($bookingId){
        $booking = Booking::findOrFail($bookingId);
        return view('admin.bookings.show', compact('booking'));
    }
}
