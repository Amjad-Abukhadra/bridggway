<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'type',
        'contact_info', 
        'description',
    ];
    public function internshipOpportunities()
    {
        return $this->hasMany(InternshipOpportunity::class, 'company_id');
    }
}
