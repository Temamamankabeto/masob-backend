<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Woreda extends Model
{
    protected $fillable = ['subcity_id','city_id','name','code','is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function subcity()
    {
        return $this->belongsTo(Subcity::class);
    }
}
