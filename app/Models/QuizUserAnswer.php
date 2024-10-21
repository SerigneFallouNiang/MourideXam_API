<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizUserAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

     // Relation avec le résultat du quiz
     public function quizResult()
     {
         return $this->belongsTo(QuizResult::class);
     }
 
     // Relation avec la question du quiz
     public function quizQuestion()
     {
         return $this->belongsTo(Question::class);
     }
 
     // Relation avec la réponse choisie par l'utilisateur
     public function quizAnswer()
     {
         return $this->belongsTo(Answer::class);
     }
}
