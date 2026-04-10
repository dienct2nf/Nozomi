<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Carbon;

class Worklist extends Model
{
    protected $fillable = ['title', 'description', 'order', 'active', 'user_id', 'start_at', 'end_at'];

    public function users()
    {
        return $this->morphedByMany(User::class, 'assignables');
    }

    public function departments()
    {
        return $this->morphedByMany(Department::class, 'assignables');
    }

     // set date
     public function setStartAtAttribute($input)
     {
         $this->attributes['start_at'] = Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d');
     }

     // set date
     public function setEndAtAttribute($input)
     {
         $this->attributes['end_at'] = Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d');
     }

     // author
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
