<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'super_department',
        'college_id',
        'email',
        'password',
        'status',
    ];

    protected $guarded = ['id'];

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
}
