<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // ✅ Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'location',
        'type',
        'contact_info', 
        'description',
        'email',
        'password',
        'profile_image',
    ];

    // ✅ Relationship with InternshipOpportunity (optional)
    public function internshipOpportunities()
    {
        return $this->hasMany(InternshipOpportunity::class, 'company_id');
    }
}
