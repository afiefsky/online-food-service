<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourierLocation extends Model
{
    protected $table = 'couriers_locations';

    protected $fillable = ['courier_id', 'is_valid', 'latitude', 'longitude', 'invalid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courier()
    {
        return $this->belongsTo(UserCourier::class);
    }
}
