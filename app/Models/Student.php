<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'gpa',
        'st_department',
        'college_id',
        'supervisor_id',
        'resume',
    ];
    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function internshipOpportunities()
    {
        return $this->belongsToMany(InternshipOpportunity::class, 'applications', 'student_id', 'internship_id');
    }
}
