<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_categories';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
