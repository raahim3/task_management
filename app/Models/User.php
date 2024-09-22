<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
        'organization_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'project_users', 'user_id', 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    public function task()
    {
        return $this->hasOne(Task::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function subscription_plan()
    {
        $subscription = $this->organization->subscriptions()->where('status', 1)->first();
        return json_decode($subscription->plan_data);
    }

}
