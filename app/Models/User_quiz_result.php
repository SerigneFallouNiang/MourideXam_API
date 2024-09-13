<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_quiz_result extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le quiz
    public function quiz()
    {
        return $this->belongsTo(Quizze::class);
    }

    // Relation avec la question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relation avec la réponse
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
