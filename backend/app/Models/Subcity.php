<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcity extends Model
{
    protected $fillable = ['city_id','name','code','description','is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
