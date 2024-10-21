<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizze extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $casts = [
        'translations' => 'array',
    ];

    
    //the relation of other table
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    // public function questions()
    // {
    //     return $this->hasMany(Question::class);
    // }
    public function questions()
    {
        return $this->belongsToMany(Question::class,'quizze_question');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'quizz_user');
                  
    }

        // Ajout de la relation quizResults
        public function quizResults()
        {
            return $this->hasMany(QuizResult::class, 'quiz_id');
        }
}
