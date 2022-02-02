<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class City extends Model
{    protected $guarded = [];
    use HasFactory;

    public function cities()
    {
        return $this->hasOne(Location::class, 'city_id');
    }
}
