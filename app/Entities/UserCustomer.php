<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
    protected $table = 'users_customers';

    protected $fillable = ['user_id', 'is_active'];

    // Relationship to Order Entities = One to Many; 'One' customer has/can do 'Many' orders

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order() {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
