<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users', 'project_id', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class,'project_id');
    }


    public function activities()
    {
        return $this->hasMany(ActivityLog::class,'related_id');
    }
}
