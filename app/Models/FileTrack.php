<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileTrack extends Model
{
    protected $fillable = ['user_id', 'file_no', 'title', 'current_deparment', 'status', 'remarks'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
