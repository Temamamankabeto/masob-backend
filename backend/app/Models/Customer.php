<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'national_id',
        'address',
        'city_id',
        'subcity_id',
        'woreda_id',
        'verification_status'
    ];
}
