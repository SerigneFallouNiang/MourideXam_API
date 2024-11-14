<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    // Ajoutez ici les colonnes autorisées pour l'assignation de masse
    // protected $fillable = ['title', 'description', 'file_path'];
    protected $guarded = [];

    protected $casts = [
        'translations' => 'array',
    ];


    //the relation of the other table
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quizze::class);
    }

    public function userProgress()
    {
        return $this->hasMany(User_progres::class);
    }
}
