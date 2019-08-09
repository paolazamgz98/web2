<?php

namespace App\Http\Controllers\Front;

use MP;
use Mail;
use Auth;
use App\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingsController extends Controller
{
    public function show($id){
        $booking = Booking::findOrFail($id);
        return view('front.bookings.show', compact('booking'));
    }

    public function store(Request $request){
        $booking = Booking::create($request->all());
        /*
        Mail::send('front.bookings.email', ['booking' => $booking], function ($m) use ($booking) {
        $m->from('paola.zam.gz@outlook.com', 'Web2');
        $m->to($booking->user->email)->subject('Reservacion No.' . $booking->id );
    });
    */
    return redirect()->route('front.bookings.show', $booking->id);
}

public function index(){
    $bookings = Booking::where('user_id', Auth()->id())->get();
    return view('front.bookings.index', compact('bookings'));
}

public function sendEmai($bookingId){
    $booking = Booking::findOrFail($bookingId);
    /*Mail::send('front.bookings.email', ['booking' => $booking], function ($m) use ($booking) {
    $m->from('paola.zam.gz@outlook.com', 'Web2');
    $m->to($booking->user->email)->subject('Reservacion No.' . $booking->id );
});
*/
return redirect()->route('front.bookings.show', $booking->id);
}

public function pay(Request $request, $bookingId){
    $booking = Booking::findOrFail($bookingId);

    try {
        $customer = MP::post('/v1/customers?access_token='.env('MP_APP_ACCESS_TOKEN'), [
            'first_name' => 'Paola`',
            'last_name' => 'ZG',
            'phone' => [
                'area_code' => '52',
                'number' => '3333333333'
            ],
        ]);
        $payment = MP::post('/v1/payments?access_token='.env('MP_APP_ACCESS_TOKEN'), [
            'payment_method_id' => 'visa',
            'token' => $request->get('token'),
            'installments' => 1,
            'transaction_amount' => $booking->total,
            'payer' => [
                'entity_type' => 'individual',
                'type' => 'customer',
                'id' => $customer['response']['id'],
                'email' => 'paola@hotmail.com',
                'first_name' => 'Paola',
                'last_name' => 'ZG'
            ],
        ]);
        $booking->update([
            'payment_id' => $payment['response']['id'],
            'is_payed' => true,
        ]);
    } catch (Exception $e){
        dd($e->getMessage());
    }
    return redirect()->route('front.bookings.show', $booking->id);
}

public function getPayment($bookingId){
    $booking = Booking::findOrFail($bookingId);
    try {
        $url = '/v1/payments/' . $booking->payment_id . '?access_token='.env('MP_APP_ACCESS_TOKEN');
        $payment = MP::get($url, []);
        dd($payment);
    } catch (Exception $e){
        dd($e->getMessage());
    }
}

public function cancel($bookingId){
    $booking = Booking::findOrFail($bookingId);
    if($booking->payment_id){
        try {
            $url = '/v1/payments/' . $booking->payment_id . '/refunds?access_token='.env('MP_APP_ACCESS_TOKEN');
            $payment = MP::post($url, [
                'amount' => $booking->getCancelAmount() - 50,
            ]);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
    $booking->update([
        'cancelled' => true,
    ]);
    return redirect()->route('front.bookings.show', $booking->id);

}
}
