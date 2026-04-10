<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Plank\Mediable\Mediable;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Translatable;
    use Mediable;
    use Sluggable;


    public $translatedAttributes = ['title', 'description', 'content', 'title_seo', 'description_seo'];
    protected $fillable = ['user_id', 'img', 'slug', 'status', 'top', 'schema', 'timetop_at', 'created_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

    // category
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // tags post
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // author
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
