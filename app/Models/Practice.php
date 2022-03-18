<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;
    protected $casts = [
        'options' => 'array',
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
