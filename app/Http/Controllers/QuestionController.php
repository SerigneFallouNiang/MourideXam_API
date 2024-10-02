<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Services\TranslationService;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
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
        $questions = Question::all();
        return response()->json($questions, 200);
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreQuestionRequest $request)
{
    // Validation des données de la question
    $validatedData = $request->validate([
        'text' => 'required|string',
        'points' => 'required|integer',
    ]);

    // Créer la question
    $question = Question::create($validatedData);

    // Traduire le texte de la question dans les autres langues supportées
    $translations = [];
    foreach ($this->translationService->getSupportedLanguages() as $lang) {
        if ($lang !== $request->user()->locale) {
            $translations[$lang] = [
                'text' => $this->translationService->translate($validatedData['text'], $lang, $request->user()->locale),
                // Ajoutez d'autres champs à traduire ici si nécessaire
            ];
        }
    }

    // Assigner les traductions à la question
    $question->translations = $translations; // Assurez-vous que votre modèle gère cela
    $question->save(); // Sauvegarder la question et ses traductions dans la base de données

    return response()->json($question, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return response()->json($question, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $validatedData = $request->validate([
            'text' => 'sometimes|string',
            'points' => 'sometimes|integer'
        ]);

                // Traduire le titre et le contenu dans les autres langues supportées
                $translations = [];
                foreach ($this->translationService->getSupportedLanguages() as $lang) {
                    if ($lang !== $request->user()->locale) {
                        $translations[$lang] = [
                            'text' => $this->translationService->translate($question->text, $lang, $request->user()->locale),
                        ];
                    }
                }
            
                // Assigner les traductions
                $question->translations = $translations;

        $question->update($validatedData);
        return response()->json($question, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(null, 204);
    }
}
