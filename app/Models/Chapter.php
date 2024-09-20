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



      // Méthode pour ajouter une vidéo au chapitre
      public function addVideo($file)
      {
          $this->addMedia($file)
               ->toMediaCollection('videos');
      }
  
      // Méthode pour récupérer les vidéos du chapitre
      public function videos()
      {
          return $this->getMedia('videos');
      }


       // Méthode pour définir la relation avec les vidéos
    public function relationvideos()
    {
        return $this->media()->where('collection_name', 'videos');
    }



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
