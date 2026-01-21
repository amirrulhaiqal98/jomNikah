<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'subdomain',
        'package_tier',
        'wish_present_enabled',
        'digital_ang_pow_enabled',
        'bride_name',
        'groom_name',
        'wedding_date',
        'venue',
        'template',
        'setup_progress',
    ];

    protected $casts = [
        'wedding_date' => 'datetime',
        'wish_present_enabled' => 'boolean',
        'digital_ang_pow_enabled' => 'boolean',
    ];

    // Relationship: Wedding has one couple user
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
