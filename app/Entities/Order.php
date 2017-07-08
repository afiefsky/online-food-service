<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['customer_id', 'courier_id', 'is_delivered', 'is_cancelled'];

    // Relationship to Customer Entities = Many to One
    public function customer() {
        return $this->belongsTo(UserCustomer::class);
    }

    // Relationship to Courier Entities = Many to One
    public function courier() {
        return $this->belongsTo(UserCourier::class);
    }

    // Relationship to Cancellation Entities = One to One
    public function cancellation() {
        return $this->hasOne(Cancellation::class);
    }
}
