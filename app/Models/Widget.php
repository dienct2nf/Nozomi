<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{

    protected $table = 'widgets';
    protected $fillable = ['title', 'description', 'user_id'];

    // author
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getAllWidgets()
    {
        return \Cache::rememberForever('widgets.all', function() {
            return self::all();
        });
    }
}
