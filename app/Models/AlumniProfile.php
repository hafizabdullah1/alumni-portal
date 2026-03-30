<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniProfile extends Model
{
    protected $fillable = [
        'user_id',
        'graduation_year',
        'department',
        'job_title',
        'company',
        'location',
        'linkedin_url',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
