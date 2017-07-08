<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table = 'meals';

    protected $fillable = ['name', 'img_url', 'vendor_id', 'meal_type_id', 'is_available'];

    public function price() {
        $this->hasMany(MealPrice::class);
    }

}
