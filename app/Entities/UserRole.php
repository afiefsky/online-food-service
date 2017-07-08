<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'users_roles';

    protected $fillable = ['user_id', 'role_id'];

    public $timestamps = false;
}
