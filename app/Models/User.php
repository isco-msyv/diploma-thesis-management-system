<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'type',
        'email',
        'password',
        'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeVerified($query)
    {
        return $query->where('is_verified', '=', true);
    }

    public function studentProject(): HasOne
    {
        return $this->hasOne(Project::class, 'student_id', 'id');
    }

    public function studentProjectRequest(): HasOne
    {
        return $this->hasOne(ProjectRequest::class, 'student_id', 'id');
    }
}
