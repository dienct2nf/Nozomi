<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Plank\Mediable\Mediable;
use App\Models\Workflow\Department;
use App\Models\Workflow\Worklist;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use Mediable;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guard_name = 'web';

    protected $fillable = ['name', 'description', 'address', 'phone', 'img', 'lastname', 'firstname', 'email', 'job_id', 'department_id', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the job record associated with the user.
     */
    public function job()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }

    /**
     * Department
     */

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /**
     * worklists
     */
    public function worklists()
    {
        return $this->morphToMany(Worklist::class, 'assingables');
    }
}
