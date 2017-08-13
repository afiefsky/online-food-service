<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserCourier extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_couriers';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'is_active'];

    // Relationship to Order Entity = One to Many; 'One' customer has/can do 'Many' orders
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function location()
    {
        return $this->hasMany(CourierLocation::class, 'courier_id');
    }
}
