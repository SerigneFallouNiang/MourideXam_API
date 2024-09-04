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
    protected $fillable = ['title', 'description', 'file_path'];

    

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
}
