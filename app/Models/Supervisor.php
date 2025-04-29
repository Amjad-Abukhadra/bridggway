<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'super_department',
        'college_id',
    ];

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    
}
