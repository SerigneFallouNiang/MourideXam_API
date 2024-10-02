<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Chapter;
use Spatie\PdfToImage\Pdf;
use App\Models\User_progres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;

class ChapterController extends Controller
{

    // function __construct()
    // {
    //      $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:category-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapter = Chapter::all();
        return response()->json(['message' => 'Liste des chapitres', 'Chapitre' => $chapter], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request)
    {
        // dd($request);
        try {
         // Valider la requête
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|mimes:mp4,avi,mov|max:30000',
            // 'lien' => 'nullable|string',
            'book_id' => 'required|exists:books,id',
            'pdf' => 'required|mimes:pdf|max:20000', 
        ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json($e->errors(), 422);  // Voir les erreurs de validation
            }


        // Stocker le fichier PDF
        $pdfPath = $request->file('pdf')->store('public/pdf');
        $relativePdfPath = 'pdf/' . basename($pdfPath);

        // Stocker la vidéo
        $videoPath = $request->file('video')->store('public/videos');
        $relativeVideoPath = 'videos/' . basename($videoPath);


      // Créer l'enregistrement dans la base de données
        $chapter = Chapter::create([
            'title' => $request->title,
            'description' => $request->description,
            // 'lien' => $request->lien,
            'file_path' => $relativePdfPath, // Stocke le chemin du PDF
            'video_path' => $relativeVideoPath, // Stocke le chemin de la vidéo
            'book_id' => $request->book_id,
        ]);

        return response()->json(['message' => 'Chapitre créé avec succès', 'chapter' => $chapter], 201);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'video' => 'nullable|mimes:mp4,avi,mov|max:30000',
        'pdf' => 'nullable|mimes:pdf|max:20000',
    ]);

    $validatedData = $request->all();

    // Gérer le fichier PDF
    if ($request->hasFile('pdf')) {
        // Supprimer l'ancien fichier s'il existe
        if ($chapter->file_path) {
            Storage::delete($chapter->file_path);
        }
        // Stocker le nouveau fichier PDF
        $pdfPath = $request->file('pdf')->store('public/pdf');
        $validatedData['file_path'] = 'pdf/' . basename($pdfPath);
    }

    // Gérer le fichier vidéo
    if ($request->hasFile('video')) {
        // Supprimer l'ancienne vidéo s'il y en a une
        if ($chapter->video_path) {
            Storage::delete($chapter->video_path);
        }
        // Stocker la nouvelle vidéo
        $videoPath = $request->file('video')->store('public/videos');
        $validatedData['video_path'] = 'videos/' . basename($videoPath);
    }

    // Mettre à jour le chapitre
    $chapter->update($validatedData);

    return response()->json(['message' => 'Chapitre mis à jour avec succès', 'chapter' => $chapter], 200);
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
    




    /**
     * Retourner le fichier PDF du chapitre spécifié.
     */
    // Télécharger un pdf 
    public function downloadPdf($chapterId)
    {
        // Récupérer le chapitre
        $chapter = Chapter::findOrFail($chapterId);

        // Chemin complet vers le fichier PDF
        $pdfPath = storage_path('app/' . $chapter->file_path);

        // Vérifier si le fichier existe
        if (!file_exists($pdfPath)) {
            return response()->json(['message' => 'Fichier PDF non trouvé'], 404);
        }

        // Retourner le fichier PDF en tant que réponse HTTP
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($pdfPath) . '"'
        ]);
    }

    //télécharger un video
    public function downloadVideo($chapterId)
{
    $chapter = Chapter::findOrFail($chapterId);

    // Chemin complet vers le fichier vidéo
    $videoPath = storage_path('app/' . $chapter->video_path);

    // Vérifier si le fichier existe
    if (!file_exists($videoPath)) {
        return response()->json(['message' => 'Fichier vidéo non trouvé'], 404);
    }

    // Retourner le fichier vidéo en tant que réponse HTTP
    return response()->file($videoPath, [
        'Content-Type' => 'video/mp4', // ou le type MIME correspondant
        'Content-Disposition' => 'inline; filename="' . basename($videoPath) . '"'
    ]);
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


//fonction pour uploader une video pour un chapitre
    // public function uploadVideo(Request $request, $chapterId)
    // {
    //     $request->validate([
    //         'video' => 'required|mimes:mp4,avi,mov|max:20000', 
    //     ]);

    //     $chapter = Chapter::findOrFail($chapterId);

    //     // Ajoutez la vidéo au chapitre
    //     $chapter->addVideo($request->file('video'));

    //     return response()->json(['message' => 'Video uploaded successfully']);
    // }


    

     // Afficher la vidéo d'un chapitre
    //  public function readVideo($id)
    //  {
    //      $chapter = Chapter::findOrFail($id);
    //      $video = $chapter->relationvideos->first(); // Obtenir la première vidéo, s'il y en a une
 
    //      if (!$video) {
    //          return response()->json(['message' => 'No video found for this chapter'], 404);
    //      }
 
    //      return response()->json([
    //          'chapter' => $chapter,
    //          'video' => [
    //              'id' => $video->id,
    //              'url' => $video->getUrl(), // Obtenir l'URL de la vidéo
    //              'name' => $video->name, // Nom du fichier vidéo
    //              'mime_type' => $video->mime_type // Type MIME
    //          ]
    //      ]);
    //  }


    // public function getChapterEtatByUser($bookId)
    // {
    //     // Récupérer l'utilisateur authentifié
    //     $user = Auth::user();
    
    //     // Vérifier si l'utilisateur est authentifié
    //     if (!$user) {
    //         $chapter = Chapter::all();
    //         return response()->json(['message' => 'Liste des chapitres', 'Chapitres' => $chapter], 201);
    //     }

    //     // Récupérer les chapitres avec la progression de l'utilisateur
    //     $chapters = Chapter::with(['userProgress' => function($query) use ($user) {
    //         $query->where('user_id', $user->id);
    //     }])->where('book_id', $bookId)->get();
    
    //     // Marquer l'état de lecture pour chaque chapitre
    //     $chapters = $chapters->map(function ($chapter) {
    //         // Si l'utilisateur a progressé dans le chapitre, ajouter l'état lu
    //         $chapter->is_read = $chapter->userProgress->isNotEmpty() && $chapter->userProgress[0]->lu;
    //         $chapter->lu = $chapter->userProgress->isNotEmpty() && $chapter->userProgress[0]->lu;
    //         $chapter->terminer = $chapter->userProgress->isNotEmpty() && $chapter->userProgress[0]->terminer;
    //         return $chapter;
            
    //     });
    
    //     return response()->json($chapters);
    // }
    
    public function getChapterEtatByUser($bookId)
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
        
        // Si l'utilisateur n'est pas authentifié, retourner tous les chapitres sans état
        if (!$user) {
            $chapters = Chapter::where('book_id', $bookId)->get();
            return response()->json([
                'message' => 'Liste des chapitres',
                'Chapitres' => $chapters->map(function ($chapter) {
                    return [
                        'id' => $chapter->id,
                        'Titre du chapitre' => $chapter->title,
                        'Lien' => $chapter->lien,
                        'Description' => $chapter->description,
                        'Fichier' => $chapter->file_path,
                        'Video' => $chapter->video_path,
                        'lue' => false,
                        'terminer' => false,
                    ];
                })
            ], 200);
        }
    
        // Récupérer les chapitres avec la progression de l'utilisateur
        $chapters = Chapter::with(['userProgress' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->where('book_id', $bookId)->get();
        
        // Formater la réponse avec l'état de lecture de l'utilisateur
        return response()->json([
            'message' => 'Chapitres récupérés avec succès',
            'Livre' => Book::find($bookId)->title,
            'Chapitres' => $chapters->map(function ($chapter) {
                return [
                    'id' => $chapter->id,
                    'Titre du chapitre' => $chapter->title,
                    'Lien' => $chapter->lien,
                    'Description' => $chapter->description,
                    'Fichier' => $chapter->file_path,
                    'Video' => $chapter->video_path,
                    // Ajouter l'état "lu" et "terminer" selon la progression de l'utilisateur
                    'lue' => $chapter->userProgress->isNotEmpty() && $chapter->userProgress[0]->lu,
                    'terminer' => $chapter->userProgress->isNotEmpty() && $chapter->userProgress[0]->terminer,
                ];
            })
        ], 200);
    }
      

}
