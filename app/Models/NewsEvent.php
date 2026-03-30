<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsEvent extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image_url',
        'type',
        'event_date',
        'is_public',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'is_public' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
