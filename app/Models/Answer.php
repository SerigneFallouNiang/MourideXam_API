<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'translations' => 'array',
    ];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relation avec les résultats de quiz
    public function quizResults()
    {
        return $this->hasMany(User_quiz_result::class);
    }
}
