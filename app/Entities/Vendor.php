<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = ['name', 'address', 'phone'];

    public function user() {
        return $this->belongsToMany(User::class, 'users_vendors', 'vendor_id', 'user_id');
    }

    public function meal() {
        return $this->hasMany(Meal::class);
    }
}
