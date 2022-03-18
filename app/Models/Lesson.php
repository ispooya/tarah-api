<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $appends = ['practices_count','get_practices'];
    protected $casts = [
        'quotation' => 'array',
    ];
    public function pourse(){
        return $this->belongsTo(Course::class);
    }
    public function practices(){
        return $this->hasMany(Practice::class);
    }
    public function getpracticesCountAttribute(){
        return count($this->practices);
    }
    public function getGetPracticesAttribute(){
        return $this->practices;
    }
}
