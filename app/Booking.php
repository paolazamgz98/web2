<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'vehicle_id', 'payment_id', 'picking_location_id', 'dropping_location_id', 'start_from', 'finish_date', 'subtotal', 'discount', 'airport_fee', 'different_location_fee', 'total', 'promo', 'days', 'hours', 'is_payed', 'is_confirmed', 'cancelled',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pickingLocation(){
        return $this->belongsTo(Location::class, 'picking_location_id');
    }

    public function droppingLocation(){
        return $this->belongsTo(Location::class, 'dropping_location_id');
    }

    public function getCancelAmount(){
        $createdAt = Carbon::parse($this->created_at);
        $now = Carbon::today();
        $hoursFromCreatedAt = $now->diffInHours($createdAt);
        $amount = 0;
        if($hoursFromCreatedAt <= 24){
            $amount = $this->total;
        }else{
            $startFrom = Carbon::parse($this->start_from);
            $hourDifference = $now->diffInHours($startFrom);
            if($hourDifference >= 48){
                $amount = $this->total * 0.5;
            }else if($hourDifference > 0){
                $amount = $this->total * 0.25;
            }
        }
        return $amount;
    }

    public function canCancel(){
        $canCancel = true;
        if($this->cancelled){
            $canCancel = false;
        }
        $now = Carbon::today();
        $startFrom = Carbon::parse($this->start_from);
        $hourDifference = $now->diffInHours($startFrom);
        if($hourDifference <= 0){
            $canCancel = false;
        }
        return $canCancel;
    }
}
