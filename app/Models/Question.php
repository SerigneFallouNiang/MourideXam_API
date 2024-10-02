<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'translations' => 'array',
    ];


 
    public function quizzes()
    {
        return $this->belongsToMany(Quizze::class, 'quizze_question');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
