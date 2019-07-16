<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'street',
        'ext_number',
        'neighborghood',
        'zip_code',
        'state',
        'city',
        'country',
    ];
}
