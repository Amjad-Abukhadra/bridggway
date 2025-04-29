<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'internship_opportunity_id',
        'status',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function internshipOpportunity()
    {
        return $this->belongsTo(InternshipOpportunity::class, 'internship_id');
    }
}
