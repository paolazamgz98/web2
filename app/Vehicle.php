<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'model',
        'color',
        'price',
        'image_url'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
