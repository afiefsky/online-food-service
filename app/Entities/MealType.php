<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    protected $table = 'meals_types';

    protected $fillable = ['name', 'display_name', 'description', 'icon_url'];

    public function meal() {
        return $this->hasMany(Meal::class);
    }
}
