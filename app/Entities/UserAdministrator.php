<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserAdministrator extends Model
{
    protected $table = 'users_administrators';

    protected $fillable = ['user_id', 'is_active'];
}
