<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = ['user_id', 'semester', 'subject', 'grade', 'gpa', 'file_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
