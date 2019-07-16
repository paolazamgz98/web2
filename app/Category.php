<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
        'price',
        'is_active',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
