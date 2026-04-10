<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Carbon;
class Product extends Model
{
    use Mediable;
    use Sluggable;

    protected $fillable = ['name', 'description', 'slot', 'workplace', 'content', 'price', 'date', 'img', 'slug', 'status', 'user_id', 'top', 'top_time'];

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

    // set date
    public function setDateAttribute($input)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d');
    }

    // set price
    public function setPriceAttribute($input)
    {
        $this->attributes['price'] = str_replace('.', '', $input);
    }

    // author
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // order
    public function orders() {
        return $this->belongsToMany(CustomerOrder::class);
    }
}
