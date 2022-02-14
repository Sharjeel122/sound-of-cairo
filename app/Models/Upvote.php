<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    protected $guarded = [];
    use HasFactory;

    // relation with user model
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // relation with sound model
    public function Sound()
    {
        return $this->belongsTo(Souns::class, 'sound_id');
    }
}
