<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @var array */
    public $fillable = ['user_id', 'job_id', 'cover_letter', 'resume_path', 'status'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function job(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}
