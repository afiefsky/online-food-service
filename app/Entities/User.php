<?php

namespace OFS\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    protected $table = 'users';

    protected $fillable = [
        'first_name',       // 1
        'last_name',        // 2
        'birthplace',       // 3
        'birthdate',        // 4
        'email',            // 5
        'password',         // 6
        'gender',           // 7
        'phone',            // 8
        'avatar_url',       // 9
        'address',          // 10
        'category_id',      // 11
        'category_number'   // 12
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vendor() {
        return $this->belongsToMany(Vendor::class, 'users_vendors', 'user_id', 'vendor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role() {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer() {
        return $this->hasOne(UserCustomer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function courier() {
        return $this->hasOne(UserCourier::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
