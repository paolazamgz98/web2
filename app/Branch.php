<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $fillable = [
        'location_id', 'name'
    ];

    public function location(){
        return $this->belongsTo(Location::class, 'location_id');
    }
}
