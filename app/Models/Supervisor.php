<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Supervisor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory;
    protected $fillable = [
        'full_name',
        'super_department',
        'college_id',
        'email',
    'password',
    'status',
    ];

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    
}
