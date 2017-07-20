<?php

namespace OFS\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    protected $table = 'users';

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone', 'avatar_url'];

    // Relationship to Vendor Entities = Many to Many
    public function vendor() {
        return $this->belongsToMany(Vendor::class, 'users_vendors', 'user_id', 'vendor_id');
    }

    // Relationship to Role Entities = Many to Many
    public function role() {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer() {
        return $this->hasOne(UserCustomer::class);
    }

    // Relationship to UserCourier Entities = One to One

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function courier() {
        return $this->hasOne(UserCourier::class);
    }
}
