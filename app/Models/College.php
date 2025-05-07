<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class College extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'college_name',
        'uni_name',
        'name', 'email', 'password', 'status'
    ];

    public function supervisors()
    {
        return $this->hasMany(Supervisor::class, 'college_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'college_id');
    }
}
