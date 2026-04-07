<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_track_id',
        'from_department_id',
        'to_department_id',
        'action_by',
        'status',
        'remarks',
        'moved_at',
    ];

    protected function casts(): array
    {
        return [
            'moved_at' => 'datetime',
        ];
    }

    public const STATUS_PENDING = 'pending';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_STUCK = 'stuck';
    public const STATUS_REJECTED = 'rejected';

    public function fileTrack(): BelongsTo
    {
        return $this->belongsTo(FileTrack::class);
    }

    public function fromDepartment(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'from_department_id');
    }

    public function toDepartment(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'to_department_id');
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'action_by');
    }
}
