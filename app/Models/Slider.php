<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Plank\Mediable\Mediable;

class Slider extends Model
{
    use Translatable;
    use Mediable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['parent_id', 'img', 'active', 'group', 'order', 'link'];

    //  parent
    public function parent()
    {
        return $this->belongsTo(Slider::class, 'parent_id');
    }
    //  children
    public function children()
    {
        return $this->hasMany(Slider::class, 'parent_id');
    }
    /**
     * Get all the settings
     *
     * @return mixed
     */
    public static function getAllSliders()
    {
        return \Cache::rememberForever('sliders.all', function() {
            return self::orderBy('order', 'ASC')->get();
        });
    }
}
