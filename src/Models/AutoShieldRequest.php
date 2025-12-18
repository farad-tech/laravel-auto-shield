<?php

namespace FaradTech\LaravelAutoShield\Models;

use Illuminate\Database\Eloquent\Model;

class AutoShieldRequest extends Model
{

    protected $fillable = [
        'ip',
        'first_piece',
        'ip_version',
        'user_agent',
        'day_timestamp',
    ];
}
