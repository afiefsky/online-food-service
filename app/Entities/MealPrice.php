<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class MealPrice extends Model
{
    protected $table = 'meals_prices';

    protected $fillable = ['meal_id', 'price', 'is_valid'];

    protected $hidden = ['id', 'meal_id', 'is_valid', 'created_at', 'updated_at', 'invalid_at'];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
