<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'student_id',  // Assuming a report belongs to a student
        'supervisor_id',  // Assuming a report is linked to a supervisor
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }
}
