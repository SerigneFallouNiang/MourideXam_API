<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Services\TranslationService;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;

class AnswerController extends Controller
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
          // Récupérer toutes les réponses
          $answers = Answer::all();
          return response()->json($answers, 200);
    }

  

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreAnswerRequest $request)
    // {
    //      // Valider et créer une nouvelle réponse
    //      $validatedData = $request->validated();
    //      $answer = Answer::create($validatedData);
    //           // Traduire le titre et le contenu dans les autres langues supportées
    //     $translations = [];
    //     foreach ($this->translationService->getSupportedLanguages() as $lang) {
    //         if ($lang !== $request->user()->locale) {
    //             $translations[$lang] = [
    //                 'text' => $this->translationService->translate($answer->text, $lang, $request->user()->locale),
    //             ];
    //         }
    //     }
    
    //     // Assigner les traductions
    //     $categories->translations = $translations;
    //      return response()->json([
    //          'message' => 'Answer created successfully',
    //          'data' => $answer
    //      ], 201);
    // }

    
//     public function store(StoreAnswerRequest $request)
// {
//     // Valider et créer une nouvelle réponse
//     $validatedData = $request->validated();
//     $answer = Answer::create($validatedData);

//     // Traduire le texte de la réponse dans les autres langues supportées
//     $translations = [];
//     foreach ($this->translationService->getSupportedLanguages() as $lang) {
//         if ($lang !== $request->user()->locale) {
//             $translations[$lang] = [
//                 'text' => $this->translationService->translate($answer->text, $lang, $request->user()->locale),
//             ];
//         }
//     }

//        // Assigner les traductions
//        $answer->translations = $translations;

//         // Sauvegarder le chapitre avec les traductions
//         $answer->save();
        
//     return response()->json([
//         'message' => 'Answer created successfully',
//         'data' => $answer 
//     ], 201);
// }


    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
         // Afficher une réponse spécifique
         return response()->json($answer, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateAnswerRequest $request, Answer $answer)
    // {
    //        // Valider et mettre à jour une réponse
    //        $validatedData = $request->validated();
    //        $answer->update($validatedData);
    //        return response()->json([
    //            'message' => 'Answer updated successfully',
    //            'data' => $answer
    //        ], 200);
    // }
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        // Valider et mettre à jour une réponse
        $validatedData = $request->validated();
    
        // Vérifier si des traductions existent déjà
        $translations = $answer->translations ?? []; // Cela doit être un tableau
    
        // Mettre à jour les traductions
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            if ($lang !== $request->user()->locale) {
                // Si la traduction existe déjà, mettre à jour, sinon créer une nouvelle
                $translations[$lang] = [
                    'text' => $this->translationService->translate($answer->text, $lang, $request->user()->locale),
                ];
            }
        }
    
        // Assigner les traductions
        foreach ($translations as $lang => $translation) {
            // Supposons que vous ayez une méthode pour créer ou mettre à jour les traductions
            $answer->translations()->updateOrCreate(
                ['language' => $lang],  // Condition pour trouver une traduction existante
                $translation             // Nouvelles données de traduction
            );
        }
    
        // Mettre à jour les données de la réponse
        $answer->update($validatedData);
    
        return response()->json([
            'message' => 'Answer updated successfully',
            'data' => $answer->load('translations') // Charger les traductions associées
        ], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        // Supprimer une réponse
        $answer->delete();
        return response()->json([
            'message' => 'Answer deleted successfully'
        ], 204);
        
    }
}
