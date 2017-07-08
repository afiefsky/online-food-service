<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
    protected $table = 'users_customers';

    protected $fillable = ['user_id', 'is_active'];

    // Relationship to Order Entities = One to Many; 'One' customer has/can do 'Many' orders
    public function order() {
        return $this->hasMany(Order::class);
    }
}
