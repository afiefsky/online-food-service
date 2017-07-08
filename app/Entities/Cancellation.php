<?php

namespace OFS\Entities;

use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    protected $table = 'cancellations';

    protected $fillable = ['order_id', 'reason'];
}
