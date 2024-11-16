<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Chapter;
use Spatie\PdfToImage\Pdf;
use App\Models\User_progres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TranslationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;

class ChapterController extends Controller
{

  //dépendance pour la traduction 
  protected $translationService;

  public function __construct(TranslationService $translationService)
  {
      $this->translationService = $translationService;
  }
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapter = Chapter::all();
        return response()->json(['message' => 'Liste des chapitres', 'Chapitre' => $chapter], 201);
    }



    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreChapterRequest $request)
    // {
    //     try {
    //         // Valider la requête
    //         $validatedData = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'nullable|string',
    //             'video' => 'nullable|mimes:mp4,avi,mov|max:50000', // 50MB max pour la vidéo
    //             'book_id' => 'required|exists:books,id',
    //             'pdf' => 'nullable|mimes:pdf|max:50000', // 50MB max pour le PDF
    //         ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Retourner les erreurs de validation si elles existent
    //         return response()->json(['errors' => $e->errors()], 422);
    //     }
    
    //     $relativePdfPath = null;
    //     $relativeVideoPath = null;
    
    //     // Stocker le fichier PDF s'il existe
    //     if ($request->hasFile('pdf')) {
    //         $pdfPath = $request->file('pdf')->store('public/pdf');
    //         $relativePdfPath = 'pdf/' . basename($pdfPath);
    //     }
    
    //     // Stocker la vidéo si elle existe
    //     if ($request->hasFile('video')) {
    //         $videoPath = $request->file('video')->store('public/videos');
    //         $relativeVideoPath = 'videos/' . basename($videoPath);
    //     }
    
    //     // Créer l'enregistrement dans la base de données
    //     $chapter = Chapter::create([
    //         'title' => $validatedData['title'],
    //         'description' => $validatedData['description'],
    //         'file_path' => $relativePdfPath, // Chemin du PDF (peut être null)
    //         'video_path' => $relativeVideoPath, // Chemin de la vidéo (peut être null)
    //         'book_id' => $validatedData['book_id'],
    //     ]);
    
    //     // Traduire le titre et la description dans les autres langues supportées
    //     $translations = [];
    //     foreach ($this->translationService->getSupportedLanguages() as $lang) {
    //         if ($lang !== $request->user()->locale) {
    //             $translations[$lang] = [
    //                 'title' => $this->translationService->translate($chapter->title, $lang, $request->user()->locale),
    //                 'description' => $this->translationService->translate($chapter->description, $lang, $request->user()->locale),
    //             ];
    //         }
    //     }
    
    //     // Assigner les traductions au chapitre
    //     $chapter->translations = $translations;
    
    //     // Sauvegarder le chapitre avec les traductions
    //     $chapter->save();
    
    //     // Retourner une réponse JSON avec un message de succès et les détails du chapitre
    //     return response()->json(['message' => 'Chapitre créé avec succès', 'chapter' => $chapter], 201);
    // }
    public function store(StoreChapterRequest $request)
{
    try {
        // Valider la requête
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lien' => 'nullable|string', // Validation pour un lien valide
            'video' => 'nullable|mimes:mp4,avi,mov|max:50000', // 50MB max pour la vidéo
            'book_id' => 'required|exists:books,id',
            'pdf' => 'nullable|mimes:pdf|max:50000', // 50MB max pour le PDF
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Retourner les erreurs de validation si elles existent
        return response()->json(['errors' => $e->errors()], 422);
    }

    $relativePdfPath = null;
    $relativeVideoPath = null;

    // Stocker le fichier PDF s'il existe
    if ($request->hasFile('pdf')) {
        $pdfPath = $request->file('pdf')->store('public/pdf');
        $relativePdfPath = 'pdf/' . basename($pdfPath);
    }

    // Stocker la vidéo si elle existe
    if ($request->hasFile('video')) {
        $videoPath = $request->file('video')->store('public/videos');
        $relativeVideoPath = 'videos/' . basename($videoPath);
    }

    // Créer l'enregistrement dans la base de données
    $chapter = Chapter::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'lien' => $validatedData['lien'],
        'file_path' => $relativePdfPath, // Chemin du PDF (peut être null)
        'video_path' => $relativeVideoPath, // Chemin de la vidéo (peut être null)
        'book_id' => $validatedData['book_id'],
    ]);

    // Traduire le titre et la description dans les autres langues supportées
    $translations = [];
    foreach ($this->translationService->getSupportedLanguages() as $lang) {
        if ($lang !== $request->user()->locale) {
            $translations[$lang] = [
                'title' => $this->translationService->translate($chapter->title, $lang, $request->user()->locale),
                'description' => $this->translationService->translate($chapter->description, $lang, $request->user()->locale),
            ];
        }
    }

    // Assigner les traductions au chapitre
    $chapter->translations = $translations;

    // Sauvegarder le chapitre avec les traductions
    $chapter->save();

    // Retourner une réponse JSON avec un message de succès et les détails du chapitre
    return response()->json(['message' => 'Chapitre créé avec succès', 'chapter' => $chapter], 201);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function show(Chapter $chapter)
    {
        return response()->json(['message' => 'Liste des chapitres', 'Chapitre' => $chapter], 201);
    }


    
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        // Remplir le chapitre avec les données validées
        $chapter->fill($request->validated());
    
        // Gérer le fichier PDF
        if ($request->hasFile('pdf')) {
            if (File::exists(public_path("storage/" . $chapter->file_path))) {
                File::delete(public_path($chapter->file_path));
            }
            $pdf = $request->file('pdf');
            $chapter->file_path = $pdf->store('pdf', 'public');
        }
    
        // Gérer le fichier vidéo
        if ($request->hasFile('video')) {
            if (File::exists(public_path("storage/" . $chapter->video_path))) {
                File::delete(public_path($chapter->video_path));
            }
            $video = $request->file('video');
            $chapter->video_path = $video->store('videos', 'public');
        }
    
        // Mettre à jour les traductions
        $translations = $chapter->translations ?? [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            if ($lang !== $request->user()->locale) {
                $translations[$lang] = [
                    'title' => $this->translationService->translate($chapter->title, $lang, $request->user()->locale),
                    'description' => $this->translationService->translate($chapter->description, $lang, $request->user()->locale),
                ];
            }
        }
        $chapter->translations = $translations;
    
        // Sauvegarder les modifications
        $chapter->save();
    
        return response()->json(['message' => 'Chapitre modifié avec succès', 'Chapitre' => $chapter], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        // Supprimer le fichier PDF associé s'il existe
        if ($chapter->file_path) {
            Storage::delete($chapter->file_path);
        }
    
        // Supprimer le chapitre de la base de données
        $chapter->delete();
    
        return response()->json(['message' => 'Chapitre et fichier PDF supprimés avec succès', 'Chapitre' => $chapter], 201);
    }
    


public function markAsRead($chapterId)
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Vérifier si l'utilisateur est authentifié
    if (!$user) {
        return response()->json([
            'message' => 'Utilisateur non authentifié',
        ], 401);
    }

    // Rechercher ou créer le progrès de l'utilisateur pour le chapitre
    $userProgress = User_progres::where('user_id', $user->id)
                                ->where('chapter_id', $chapterId)
                                ->firstOrCreate(
                                    ['user_id' => $user->id, 'chapter_id' => $chapterId],
                                    ['lu' => true]  // Marquer comme lu si le progrès n'existe pas encore
                                );

    // Si le chapitre est déjà marqué comme lu, retourner un message approprié
    if ($userProgress->lu) {
        return response()->json(['message' => 'Chapitre déjà marqué comme lu.']);
    }

    // Marquer le chapitre comme lu
    $userProgress->lu = true;
    $userProgress->save();

    return response()->json([
        'message' => 'Chapitre marqué comme lu avec succès',
        'chapter_id' => $chapterId,  // Retourner l'ID du chapitre
        'user_id' => $user->id,  // Retourner l'ID de l'utilisateur
    ]);
}
    
  

public function getChapterEtatByUser($bookId)
{
    // Récupérer l'utilisateur authentifié
    $user = Auth::user();
    
    // Récupérer le livre correspondant à l'ID
    $book = Book::find($bookId);
    if (!$book) {
        return response()->json([
            'message' => 'Livre non trouvé',
        ], 404);
    }
    
    // Vérifier la locale de l'utilisateur
    $locale = $user ? $user->locale : config('app.locale');
    
    // Si l'utilisateur n'est pas authentifié, retourner tous les chapitres sans état
    if (!$user) {
        $chapters = Chapter::where('book_id', $bookId)->get();
        return response()->json([
            'message' => 'Liste des chapitres',
            'Chapitres' => $chapters->map(function ($chapter) use ($locale) {
                return [
                    'id' => $chapter->id,
                    'Titre du chapitre' => $this->translationService->translate($chapter->title, $locale),
                    'Lien' => $chapter->lien,
                    'Description' => $this->translationService->translate($chapter->description, $locale),
                    'Fichier' => $chapter->file_path,
                    'Video' => $chapter->video_path,
                    'lue' => false,
                    'terminer' => false,
                ];
            })
        ], 200);
    }
    
    // Récupérer les chapitres avec le quiz et les résultats de quiz de l'utilisateur
    $chapters = Chapter::with(['quiz' => function($query) use ($user) {
        $query->with(['quizResults' => function($subQuery) use ($user) {
            $subQuery->where('user_id', $user->id);
        }]);
    }])->where('book_id', $bookId)->get();
    
    // Récupérer la progression de l'utilisateur
    $userProgress = User_progres::where('user_id', $user->id)
                                ->whereIn('chapter_id', $chapters->pluck('id'))
                                ->get()
                                ->keyBy('chapter_id');
    
    // Formater la réponse avec l'état de lecture de l'utilisateur et les résultats des quiz
    return response()->json([
        'message' => 'Chapitres récupérés avec succès',
        'Livre' => $this->translationService->translate($book->title, $locale),
        'Chapitres' => $chapters->map(function ($chapter) use ($locale, $userProgress) {
            $chapterProgress = $userProgress->get($chapter->id);
            $quizResult = $chapter->quiz && $chapter->quiz->quizResults->isNotEmpty() 
                        ? $chapter->quiz->quizResults->first() 
                        : null;
            
            return [
                'id' => $chapter->id,
                'Titre du chapitre' => $this->translationService->translate($chapter->title, $locale),
                'Lien' => $chapter->lien,
                'Description' => $this->translationService->translate($chapter->description, $locale),
                'Fichier' => $chapter->file_path,
                'Video' => $chapter->video_path,
                'lue' => $chapterProgress ? $chapterProgress->lu : false,
               'terminer' => $quizResult ? $quizResult->terminer : false,
                'score' => $quizResult ? $quizResult->score : null,
                'is_passed' => $quizResult ? $quizResult->is_passed : false,
            ];
        })
    ], 200);
}

}
