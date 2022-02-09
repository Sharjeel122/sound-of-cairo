<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];
    use HasFactory;
    // relation with parent main category
    public function sub_categories()
    {
        return $this->belongsTo(sub_categories::class, 'category_id');
    }
    // relation with subcategory
    public function SubCategory()
    {
        return $this->hasMany(sub_categories::class, 'sub_category_id');
    }
}
