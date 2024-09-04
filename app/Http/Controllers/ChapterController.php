<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Chapter;
use Spatie\PdfToImage\Pdf;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use Illuminate\Support\Facades\Storage;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'description' => 'nullable|string',
            'pdf' => 'required|mimes:pdf|max:10000', // Taille maximale de 10 Mo
        ]);

        // Stocker le fichier PDF dans storage/app/public/pdf
        $filePath = $request->file('pdf')->store('public/pdf');

        // Créer l'enregistrement dans la base de données
        $chapter = Chapter::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        //
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


    
    //afficher un video
    public function readVideo($id)
    {
        $chapter = Chapter::findOrFail($id);
        $videos = $chapter->videos;

        return view('chapters.show', compact('chapter', 'videos'));
    }
}
