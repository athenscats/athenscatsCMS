<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
use SoftDeletes;
use HasSlug;

public function getSlugOptions() : SlugOptions
{
    return SlugOptions::create()
        ->generateSlugsFrom('title')
        ->saveSlugsTo('slug');
}

    protected $fillable = [
        'title', 'content','featured','category_id','slug'
    ];

    public function getFeaturedAttribute($featured)
    {
        return asset($featured);
    }

    protected $dates = ['deleted_at'];

    public function category()
    {
  
        return $this->belongsTo('App\Category');
    }
    public function tags()
    {
    
        return $this->belongsToMany('App\Tag');
    }
}
