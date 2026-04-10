<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Plank\Mediable\Mediable;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{

    use Translatable;
    use Mediable;
    use Sluggable;

    public $translatedAttributes = ['title', 'description', 'title_seo', 'description_seo'];
    protected $fillable = ['user_id', 'parent_id', 'img', 'slug'];

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

    //  parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    //  children
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    // post of category
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    // author
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
