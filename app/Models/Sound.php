<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    protected $guarded = [];
    use HasFactory;

    // relation with sound
    public function sounds()
    {
        return $this->belongsTo(users::class, 'user_id');
    }
    // relation with location
    public function locations()
    {
        return $this->belongsTo(locations::class, 'location_id');
    }
    // relation with tags
    public function tags()
    {
        return $this->belongsTo(tags::class, 'tag_id');
    }
    // relation with category
    public function Category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
    // relation with sub category
    public function SubCategory()
    {
        return $this->belongsTo(sub_categories::class, 'category_id');
    }
    //
    public function SoundUpload()
    {
        return $this->hasMany(SoundUpload::class, 'sound_id');
    }
}
