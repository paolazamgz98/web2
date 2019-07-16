<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'car_id', 'start_from', 'finish_date', 'amount', 'is_payed', 'is_confirmed', 'cancelled',
    ];
}
