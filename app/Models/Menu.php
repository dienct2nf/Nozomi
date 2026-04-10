<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Menu as MenuParent;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = ['name'];

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }
    public static function getAllMenu($value)
    {
        return \Cache::rememberForever('menu.'.$value, function() use ($value){
            return MenuParent::getByName($value);
        });
    }
}
