<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class UserVendor extends Model
{
    protected $table = 'users_vendors';

    protected $fillable = ['user_id', 'vendor_id'];

    public $timestamps = false;
}
