<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'description', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function subcities()
    {
        return $this->hasMany(Subcity::class);
    }

    public function woredas()
    {
        return $this->hasMany(Woreda::class);
    }
}
