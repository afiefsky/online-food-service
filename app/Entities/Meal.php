<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table = 'meals';

    protected $fillable = ['name', 'display_name', 'img_url', 'vendor_id', 'meal_type_id', 'is_available'];

    public function price()
    {
        return $this->hasMany(MealPrice::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function type()
    {
        return $this->belongsTo(MealType::class);
    }
}
