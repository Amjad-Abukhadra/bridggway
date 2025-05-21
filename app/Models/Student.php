<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Supervisor;
class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory;
    protected $fillable = [
        'full_name',
        'gpa',
        'st_department',
        'college_id',
        'supervisor_id',
        'resume',
        'email',
    'password',
    'status',
    ];
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'super_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function internshipOpportunities()
    {
        return $this->belongsToMany(InternshipOpportunity::class, 'applications', 'std_id', 'internship_id');
    }
}
