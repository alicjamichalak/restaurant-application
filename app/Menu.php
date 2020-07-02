<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'menu_id';

    public function foodType()
    {
        return $this->hasOne(FoodType::class);
    }
}
