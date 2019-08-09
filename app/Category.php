<?php

namespace App;
use \Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'disabled_from',
        'disabled_to',
    ];

    public function isAvailable(){
        $available = true;
        if($this->disabled_from && $this->disabled_to){
            if(Carbon::today() >= $this->disabled_from){
                if(Carbon::today() <= $this->disabled_to){
                    $available = false;
                }
            }
        }
        return $available;
    }
}
