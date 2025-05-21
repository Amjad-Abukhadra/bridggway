<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'super_id',
        'std_id',
        'internship_id',
        'comp_id',
        'status',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'std_id');
    }

    public function internshipOpportunity()
    {
        return $this->belongsTo(InternshipOpportunity::class, 'internship_id');
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
