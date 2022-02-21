<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoundCollection extends Model
{
    use HasFactory;
 protected $guarded = [];

   // relation with user table
    public function User()
    {
        return $this->hasMany(User::class, 'user_id');
    }
    // relation with sound model
    public function Sound()
    {
        return $this->belongsTo(Sound::class, 'sound_id');
    }

   // relation with sound model
    public function Collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }
}
