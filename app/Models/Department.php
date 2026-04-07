<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'head_name',
        'email',
        'phone',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function fileTracks(): HasMany
    {
        return $this->hasMany(FileTrack::class);
    }

    public function fileMovements(): HasMany
    {
        return $this->hasMany(FileMovement::class);
    }
}
