<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    // Ajoutez ici les colonnes autorisées pour l'assignation de masse
    protected $fillable = ['title', 'description', 'file_path'];
}
