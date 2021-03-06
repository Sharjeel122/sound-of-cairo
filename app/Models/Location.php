<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Location extends Model
{    protected $guarded = [];
    use HasFactory;

   public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
