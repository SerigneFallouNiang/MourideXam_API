<?php

namespace App\Http\Controllers;

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
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
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



    // Cette méthode convertit chaque page du PDF en image et les enregistre dans storage/app/public/images/. 
    // public function convertToImages($chapterId)
    // {
    //     // Récupérer le chapitre
    //     $chapter = Chapter::findOrFail($chapterId);

    //     // Chemin complet vers le fichier PDF
    //     $pdfPath = storage_path('app/' . $chapter->file_path);

    //     // Initialiser l'objet Pdf avec le fichier
    //     $pdf = new Pdf($pdfPath);

    //     // Stocker les images générées
    //     $images = [];

    //     // Convertir chaque page du PDF en image
    //     for ($page = 1; $page <= $pdf->getNumberOfPages(); $page++) {
    //         $pdf->setPage($page);

    //         // Chemin de l'image à enregistrer
    //         $imagePath = 'public/images/chapter_' . $chapterId . '_page_' . $page . '.png';
    //         $pdf->saveImage(storage_path('app/' . $imagePath));

    //         // Ajouter le chemin de l'image générée à la liste
    //         $images[] = Storage::url($imagePath); // URL de l'image
    //     }

    //     return response()->json(['message' => 'PDF converti avec succès en images', 'images' => $images]);
    // }

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
}
