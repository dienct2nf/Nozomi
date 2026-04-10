<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;
use Illuminate\Support\Carbon;

class Customer extends Model
{
    use Mediable;

    protected $fillable = ['full_name', 'first_name', 'middle_name', 'last_name', 'birth_day', 'address', 'phone', 'email', 'sex', 'img', 'other_details', 'metadata'];

    // set date
    public function setBirthDayAttribute($input)
    {
        if(is_numeric($input) && $input > 1900){
            $input = "01/01/$input";
        }
        $this->attributes['birth_day'] = Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d');
    }

    // order
    public function order(){
        return $this->hasMany(CustomerOrder::class);
    }
}
