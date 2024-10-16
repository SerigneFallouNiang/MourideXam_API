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

}
