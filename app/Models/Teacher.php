<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lessons', 'classroom_id'];

    protected $casts = ['lessons' => 'array'];

    protected $hidden = ['created_at', 'updated_at'];

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
}
