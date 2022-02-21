<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    protected $guarded = [];
    use HasFactory;

  // relation with sound
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // relation with location
    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    // relation with tags
    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
    // relation with category
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // relation with sub category
    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    // relation with soundupload table
    public function SoundUpload()
    {
        return $this->hasMany(SoundUpload::class, 'sound_id');
    }

    // relation with upvote model
    public function Upvote()
    {
        return $this->hasMany(Upvote::class, 'sound_id');
    }
    // relation with Saved Sound
    public function SaveSound()
    {
        return $this->hasMany(SaveSound::class, 'sound_id');
    }
}
