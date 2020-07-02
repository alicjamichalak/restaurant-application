<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'food_type_id';

    public function restaurantMenu()
    {
        return $this->belongsTo(Menu::class);
    }
}
