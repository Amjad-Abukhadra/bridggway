<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'student_id',
        'comp_id',
        'super_id',
        'week_number',
        'task',
        'tools',
        'number_of_hours',
        'performance_level',
        'responsibility',
        'punctuality',
        'accuracy_in_work',
        'teamwork',
        'adaptability',
        'skill_acquisition_speed',
        'overall_completion'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'comp_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'super_id');
    }
}
