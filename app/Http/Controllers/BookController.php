<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Http\Controllers\Controller;
use App\Services\TranslationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
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
        $livres = Book::all();
        return response()->json(['message' => 'Liste des livres', 'Livres' => $livres], 201);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $livre = new Book();
        $livre->fill($request->validated());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $livre->image = $image->store('livres', 'public');
        }

        // Traduire le titre et le contenu dans les autres langues supportées
        $translations = [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            if ($lang !== $request->user()->locale) {
                $translations[$lang] = [
                    'title' => $this->translationService->translate($livre->title, $lang, $request->user()->locale),
                    'description' => $this->translationService->translate($livre->description, $lang, $request->user()->locale),
                ];
            }
        }

          // Assigner les traductions
          $livre->translations = $translations;
        $livre->save();
        return response()->json(['message' => 'Livre créé avec succès', 'Livre' => $livre], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $chapters = $book->chapters;
        return response()->json(['message' => 'Liste des chapitres', 'chapitres' => $chapters], 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // $chapters = $book->chapters;
        return response()->json(['message' => 'Livre Show', 'book' => $book], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->fill($request->validated());
        if ($request->hasFile('image')) {

            if (File::exists(public_path("storage/" . $book->image))) {
                File::delete(public_path($book->image));
            }
            $image = $request->file('image');
            $book->image = $image->store('livres', 'public');
        }
        // dd($livre->image);
        if ($book->quantite > 0) {
            $book->update(['disponible' => true]);
        }

           // Mettre à jour les traductions
        $translations = $category->translations ?? [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            if ($lang !== $request->user()->locale) {
                $translations[$lang] = [
                    'title' => $this->translationService->translate($book->title, $lang, $request->user()->locale),
                    'description' => $this->translationService->translate($book->description, $lang, $request->user()->locale),
                ];
            }
        }

        $book->translations = $translations;
        $book->update();
        return response()->json(['message' => 'Livre modifié avec succès', 'Livre' => $book], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Livre supprimé avec succès', 'Livre' => $book], 201);
    }



//pour voir l'historie d'un utilisateur
public function getBooksWithReadChaptersByUser()
{
    // Récupérer l'utilisateur authentifié
    $user = Auth::user();
    
    // Si l'utilisateur n'est pas authentifié, retourner une erreur
    if (!$user) {
        return response()->json([
            'message' => 'Utilisateur non authentifié',
        ], 401);
    }

    // Récupérer tous les livres qui ont au moins un chapitre avec un quiz terminé par cet utilisateur
    $books = Book::whereHas('chapters.quiz.quizResults', function ($query) use ($user) {
        $query->where('user_id', $user->id)
              ->whereIn('terminer', [1, 2]); // Condition pour les quiz terminés ou lus par cet utilisateur
    })->with(['chapters.quiz' => function ($query) use ($user) {
        // Charger les résultats de quiz pour calculer le pourcentage de progression
        $query->withCount(['quizResults as completed_count' => function ($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->where('terminer', 1); // Seulement les quiz terminés
        }]);
    }])->get();

    // Si aucun livre n'est trouvé
    if ($books->isEmpty()) {
        return response()->json([
            'message' => 'Aucun livre avec des chapitres terminés trouvé pour cet utilisateur',
            'books' => []
        ], 200);
    }

        // Récupérer la langue choisie par l'utilisateur ou utiliser la locale par défaut
        $locale = app()->getLocale();


    // Préparer les livres avec le pourcentage de progression
    $booksWithProgress = $books->map(function ($book) use ($locale){
        $totalChapters = $book->chapters->count(); // Nombre total de chapitres
        $completedChapters = $book->chapters->sum('quiz.completed_count'); // Nombre de chapitres/quiz terminés
        $progress = $totalChapters > 0 ? round(($completedChapters / $totalChapters) * 100, 2) : 0; // Calcul du pourcentage

       
           // Récupérer les traductions du champ translations
           $translations = $book->translations;

        return [
            'id' => $book->id,
            // 'title' => $book->title,
            'title' => $translations[$locale]['title'] ?? $book->title,
            'image' => $book->image,
            // 'description' => $book->description,
            'description' => $translations[$locale]['description'] ?? $book->description,
            'category_id' => $book->category_id,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
            'translations' => $book->translations, // Assurez-vous que le champ `translations` est bien défini
            'total_chapters' => $totalChapters,
            'completed_chapters' => $completedChapters,
            'progress' => $progress // Pourcentage de progression
        ];
    });

    // Retourner les livres avec le pourcentage de progression
    return response()->json([
        'message' => 'Livres avec progression des chapitres terminés récupérés avec succès pour l\'utilisateur',
        'books' => $booksWithProgress
    ], 200);
}


//pour le nombre des livres
public function count()
{
    $count = Book::count(); // Compte le nombre total de livres
    return response()->json(['message' => 'Nombre total de livres récupéré avec succès', 'count' => $count], 200);
}
}
