<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
         // Valider la requête
         $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'lien' => 'nullable|string',
            "book_id" => ["required", "exists:books,id"],
            'pdf' => 'required|mimes:pdf|max:10000', // Taille maximale de 10 Mo
        ]);

        // Stocker le fichier PDF dans storage/app/public/pdf
        $filePath = $request->file('pdf')->store('public/pdf');

        // Créer l'enregistrement dans la base de données
        $chapter = Chapter::create([
            'title' => $request->title,
            'description' => $request->description,
            'lien' => $request->lien,
            'file_path' => $filePath,
            'book_id' =>$request->book_id,
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
        $validatedData = $request->validated();
    
        // Gérer le fichier PDF
        if ($request->hasFile('pdf')) {
            // Supprimer l'ancien fichier s'il existe
            if ($chapter->file_path) {
                Storage::delete($chapter->file_path);
            }
            // Stocker le nouveau fichier PDF
            $validatedData['file_path'] = $request->file('pdf')->store('public/pdf');
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
        $chapter->delete();
        return response()->json(['message' => 'Chapitre supprimé avec succès', 'Chapitre' => $chapter], 201);
    }




    /**
     * Retourner le fichier PDF du chapitre spécifié.
     */
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

//fonction pour uploader une video pour un chapitre
    public function uploadVideo(Request $request, $chapterId)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mov|max:20000', 
        ]);

        $chapter = Chapter::findOrFail($chapterId);

        // Ajoutez la vidéo au chapitre
        $chapter->addVideo($request->file('video'));

        return response()->json(['message' => 'Video uploaded successfully']);
    }


    

     // Afficher la vidéo d'un chapitre
     public function readVideo($id)
     {
         $chapter = Chapter::findOrFail($id);
         $video = $chapter->relationvideos->first(); // Obtenir la première vidéo, s'il y en a une
 
         if (!$video) {
             return response()->json(['message' => 'No video found for this chapter'], 404);
         }
 
         return response()->json([
             'chapter' => $chapter,
             'video' => [
                 'id' => $video->id,
                 'url' => $video->getUrl(), // Obtenir l'URL de la vidéo
                 'name' => $video->name, // Nom du fichier vidéo
                 'mime_type' => $video->mime_type // Type MIME
             ]
         ]);
     }
}
