<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'display_name', 'description', 'hidden'];

    public function user() {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id');
    }
}
