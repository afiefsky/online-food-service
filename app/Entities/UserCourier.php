<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserCourier extends Model
{
    protected $table = 'users_couriers';

    protected $fillable = ['user_id', 'is_active'];

    // Relationship to Order Entity = One to Many; 'One' customer has/can do 'Many' orders
    public function order() {
        return $this->hasMany(Order::class);
    }
}
