<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;
use Cviebrock\EloquentSluggable\Sluggable;

class Album extends Model
{
    use Mediable;
    use Sluggable;

    protected $table = 'albums';
    protected $fillable = ['name', 'description', 'content', 'img', 'slug', 'user_id'];

    // author
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
