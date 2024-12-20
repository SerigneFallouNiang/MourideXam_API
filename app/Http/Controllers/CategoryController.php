<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use App\Services\TranslationService;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    //dépendance pour la traduction 
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }
    

    public function index()
    {
        // Récupérer la langue choisie par l'utilisateur ou utiliser la locale par défaut
        $locale = app()->getLocale();
    
        $categories = Category::all()->map(function ($category) use ($locale) {
            // Récupérer les traductions du champ translations
            $translations = $category->translations;
    
            return [
                'id' => $category->id,
                // Si une traduction est disponible pour la langue choisie, l'utiliser, sinon utiliser la valeur par défaut
                'name' => $translations[$locale]['name'] ?? $category->name,
                'description' => $translations[$locale]['description'] ?? $category->description,
                'image' => $category->image,
            ];
        });
    
        return response()->json(['message' => 'Liste des catégories', 'Catégorie' => $categories], 201);
    }



    // public function getBooks($categoryId)
    // {
    //     // Récupérer la langue choisie par l'utilisateur ou utiliser la locale par défaut
    //     $locale = app()->getLocale();
    
    //     // Vérifiez si la langue est prise en charge
    //     if (!in_array($locale, $this->translationService->getSupportedLanguages())) {
    //         return response()->json(['message' => 'Langue non supportée'], 400);
    //     }
    
    //     // Récupérer la catégorie par ID, ou échouer si elle n'existe pas
    //     $category = Category::findOrFail($categoryId);
    
    //     // Récupérer les livres de la catégorie
    //     $books = $category->books->map(function ($book) use ($locale) {
    //         return [
    //             'id' => $book->id,
    //             // 'title' => $this->translationService->translate($book->title, $locale),
    //             'title' => $translations[$locale]['title'] ?? $book->title,
    //             // 'description' => $this->translationService->translate($book->description, $locale)
    //             'description' => $translations[$locale]['description'] ?? $book->description,
    //             'image' =>$book->image,
    //         ];
    //     });
    
    //     // Traduire le nom de la catégorie
    //     // $translatedCategory = $this->translationService->translate($category->name, $locale);
    //     $translatedCategory = $translations[$locale]['name'] ?? $category->name;
    
    //     return response()->json([
    //         'message' => 'Livres de la catégorie ' . $translatedCategory,
    //         'category' => $translatedCategory,
    //         'books' => $books,
    //     ], 200);
    // }
    
    public function getBooks($categoryId)
{
    // Récupérer la langue choisie par l'utilisateur ou utiliser la locale par défaut
    $locale = app()->getLocale();

    // Vérifiez si la langue est prise en charge
    if (!in_array($locale, $this->translationService->getSupportedLanguages())) {
        return response()->json(['message' => 'Langue non supportée'], 400);
    }

    // Récupérer la catégorie par ID, ou échouer si elle n'existe pas
    $category = Category::findOrFail($categoryId);

    // Récupérer les livres de la catégorie
    $books = $category->books->map(function ($book) use ($locale) {
        // Traduction du titre et de la description du livre
        $translatedTitle = $book->translations[$locale]['title'] ?? $book->title;
        $translatedDescription = $book->translations[$locale]['description'] ?? $book->description;

        return [
            'id' => $book->id,
            'title' => $translatedTitle,
            'description' => $translatedDescription,
            'image' => $book->image,
        ];
    });

    // Traduire le nom de la catégorie
    $translatedCategory = $category->translations[$locale]['name'] ?? $category->name;

    return response()->json([
        'message' => 'Livres de la catégorie ' . $translatedCategory,
        'category' => $translatedCategory,
        'books' => $books,
    ], 200);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $categories = new Category();
        
        // Remplir d'abord les propriétés avec les données validées
        $categories->fill($request->validated());
        
        // Ajouter l'image si elle existe
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $categories->image = $image->store('livres', 'public');
        }
    
        // Traduire le titre et le contenu dans les autres langues supportées
        $translations = [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            if ($lang !== $request->user()->locale) {
                $translations[$lang] = [
                    'name' => $this->translationService->translate($categories->name, $lang, $request->user()->locale),
                    'description' => $this->translationService->translate($categories->description, $lang, $request->user()->locale),
                ];
            }
        }
    
        // Assigner les traductions
        $categories->translations = $translations;
        
        // Sauvegarder la catégorie
        $categories->save();
        
        return response()->json(['message' => 'Catégorie créée avec succès', 'Catégorie' => $categories], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $locale = app()->getLocale();
    
        // Récupérer la catégorie par ID ou renvoyer une erreur 404
        $category = Category::findOrFail($id);
    
        // Traduire les champs pour la langue demandée
        $categories = [
            'id' => $category->id,
            'name' => $this->translationService->translate($category->name, $locale),
            'description' => $this->translationService->translate($category->description, $locale),
            'image' => $category->image,
        ];
    
        return response()->json([
            'message' => 'Catégorie récupérée avec succès',
            'category' => $categories,
        ], 200);
    }
    


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
{
    // Remplir d'abord les propriétés avec les données validées
    $category->fill($request->validated());
    
    // Ajouter l'image si elle existe
    if ($request->hasFile('image')) {
        if (File::exists(public_path("storage/livres" . $category->image))) {
            File::delete(public_path($category->image));
        }
        $image = $request->file('image');
        $category->image = $image->store('livres', 'public');
    }

    // Mettre à jour les traductions
    $translations = $category->translations ?? [];
    foreach ($this->translationService->getSupportedLanguages() as $lang) {
        if ($lang !== $request->user()->locale) {
            $translations[$lang] = [
                'name' => $this->translationService->translate($category->name, $lang, $request->user()->locale),
                'description' => $this->translationService->translate($category->description, $lang, $request->user()->locale),
            ];
        }
    }

    $category->translations = $translations;

    // Sauvegarder les modifications
    $category->save();

    return response()->json(['message' => 'Catégorie modifiée avec succès', 'Catégorie' => $category], 201);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès',$category], 201);

    }

    public function massDestroy()
    {
        Category::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

  // Nombre toltal des catégories 
    public function countCategories(): JsonResponse
{
    // Compter le nombre total de catégories
    $count = Category::count();

    return response()->json([
        'status' => true,
        'message' => 'Total des catégories récupéré avec succès',
        'count' => $count,
    ]);
}

}
