<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'company',
        'location',
        'type',
        'description',
        'requirements',
        'apply_url',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
