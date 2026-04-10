<?php

namespace App\Models\Workflow;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['title', 'description', 'manage_id', 'parent_id', 'active'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function worklists()
    {
        return $this->morphToMany(Worklist::class, 'assignables');
    }
    //  parent
    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }
    //  children
    public function children()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

    // author
    public function manage() {
        return $this->belongsTo(User::class, 'manage_id');
    }
}
