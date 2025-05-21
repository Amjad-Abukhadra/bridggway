<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipOpportunity extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'requirements', 
        'start_time',
        'end_time',
        'company_id',
        'photo'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'applications', 'internship_id', 'student_id');
    }
}
