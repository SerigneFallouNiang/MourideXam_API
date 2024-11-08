<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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
         // Récupérer toutes les questions avec leurs réponses
     // Récupérer toutes les questions avec leurs réponses
     $questions = Question::with('answers')->get();
    
     return response()->json($questions, 200);
    }


    /**
     * Store a newly created resource in storage.
     */

// public function store(StoreQuestionRequest $request)
// {
//     // Validation des données de la question et des réponses
//     $validatedData = $request->validate([
//         'text' => 'required|string',
//         'answers' => 'required|array', // S'assurer que les réponses sont fournies sous forme de tableau
//         'answers.*.text' => 'required|string', // Chaque réponse doit avoir un texte
//         'answers.*.correct_one' => 'required|boolean', // Indiquer si la réponse est correcte ou non
//     ]);

//     // Créer la question
//     $question = Question::create([
//         'text' => $validatedData['text'],
//     ]);

//     // Gérer les réponses associées
//     $answers = [];
//     foreach ($validatedData['answers'] as $answerData) {
//         // Créer la réponse en associant l'ID de la question
//         $answer = new Answer([
//             'text' => $answerData['text'],
//             'correct_one' => $answerData['correct_one'],
//             'question_id' => $question->id,  // Utilisation de l'ID de la question ici
//         ]);

//         // Sauvegarder la réponse dans la base de données
//         $answer->save();

//         // Ajouter la réponse au tableau des réponses
//         $answers[] = $answer;
//     }

//     // Traduire la question dans d'autres langues, etc.
//     // (le reste du code suit)

//     return response()->json([
//         'message' => 'Question and answers created successfully',
//         'question' => $question,
//         'answers' => $answers
//     ], 201);
// }
public function store(StoreQuestionRequest $request)
{
    // Validation des données de la question et des réponses
    $validatedData = $request->validate([
        'text' => 'required|string',
        'answers' => 'required|array', // S'assurer que les réponses sont fournies sous forme de tableau
        'answers.*.text' => 'required|string', // Chaque réponse doit avoir un texte
        'answers.*.correct_one' => 'required|boolean', // Indiquer si la réponse est correcte ou non
    ]);

    // Créer la question avec la traduction dans la langue par défaut
    $question = Question::create([
        'text' => $this->translationService->translate($validatedData['text'], $request->user()->locale, 'en'),
    ]);

    $answers = [];
    foreach ($validatedData['answers'] as $answerData) {
        // Création d'une réponse avec les traductions dans toutes les langues prises en charge
        $translations = [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            $translatedText = $this->translationService->translate($answerData['text'], $request->user()->locale, $lang);
            $translations[$lang] = $translatedText;
        }

        // Enregistrer la réponse avec les traductions comme JSON
        $answer = Answer::create([
            'text' => $translations['en'],  // Texte en anglais par défaut
            'correct_one' => $answerData['correct_one'],
            'question_id' => $question->id,
            'translations' => $translations,  // Sauvegarde les traductions dans un champ JSON
        ]);

        // Ajouter la réponse (avec ses traductions) au tableau des réponses
        $answers[] = $answer;
    }

    // Traduire la question dans d'autres langues et sauvegarder dans la propriété `translations`
    $questionTranslations = [];
    foreach ($this->translationService->getSupportedLanguages() as $lang) {
        if ($lang !== 'en') {
            $questionTranslations[$lang] = [
                'text' => $this->translationService->translate($validatedData['text'], $request->user()->locale, $lang),
            ];
        }
    }

    $question->translations = $questionTranslations;
    $question->save();

    return response()->json([
        'message' => 'Question and answers created successfully',
        'question' => $question,
        'answers' => $answers
    ], 201);
}


    /**
     * Display the specified resource.
     */
    // public function show(Question $question)
    // {
    //     return response()->json($question, 200);

    // }
    public function show(Question $question)
{

    return response()->json([
        'question' => $question,
        'answers' => $question->answers
    ], 200);
}

    /**
     * Update the specified resource in storage.
     */

    // public function update(UpdateQuestionRequest $request, Question $question)
    // {
    //     // Validation des données de la question et des réponses
    //     $validatedData = $request->validate([
    //         'text' => 'sometimes|string',
    //         'answers' => 'sometimes|array',
    //         'answers.*.id' => 'nullable|exists:answers,id', // Pour identifier les réponses existantes
    //         'answers.*.text' => 'sometimes|string',
    //         'answers.*.correct_one' => 'sometimes|boolean',
    //     ]);
    
    //     // Mettre à jour la question
    //     $question->update([
    //         'text' => $validatedData['text'],
    //     ]);
    
    //     // Gérer les traductions
    //     $translations = [];
    //     foreach ($this->translationService->getSupportedLanguages() as $lang) {
    //         if ($lang !== $request->user()->locale) {
    //             $translations[$lang] = [
    //                 'text' => $this->translationService->translate($validatedData['text'], $lang, $request->user()->locale),
    //             ];
    //         }
    //     }
    //     $question->translations = $translations;
    //     $question->save();
    
    //     // Gérer les réponses
    //     $existingAnswerIds = $question->answers->pluck('id')->toArray();
    //     $updatedAnswerIds = [];
    
    //     foreach ($validatedData['answers'] as $answerData) {
    //         if (isset($answerData['id'])) {
    //             // Mettre à jour une réponse existante
    //             $answer = Answer::find($answerData['id']);
    //             if ($answer && $answer->question_id === $question->id) {
    //                 $answer->update([
    //                     'text' => $answerData['text'],
    //                     'correct_one' => $answerData['correct_one'],
    //                 ]);
    //                 $updatedAnswerIds[] = $answer->id;
    //             }
    //         } else {
    //             // Créer une nouvelle réponse
    //             $answer = new Answer([
    //                 'text' => $answerData['text'],
    //                 'correct_one' => $answerData['correct_one'],
    //                 'question_id' => $question->id,
    //             ]);
    //             $answer->save();
    //             $updatedAnswerIds[] = $answer->id;
    //         }
    //     }
    
    //     // Supprimer les réponses qui n'existent plus dans la mise à jour
    //     $answersToDelete = array_diff($existingAnswerIds, $updatedAnswerIds);
    //     if (!empty($answersToDelete)) {
    //         Answer::whereIn('id', $answersToDelete)->delete();
    //     }
    
    //     // Charger les relations mises à jour
    //     $question->load('answers');
    
    //     return response()->json($question, 200);
    // }
    public function update(UpdateQuestionRequest $request, Question $question)
{
    // Validation des données de la question et des réponses
    $validatedData = $request->validate([
        'text' => 'sometimes|string',
        'answers' => 'sometimes|array',
        'answers.*.id' => 'nullable|exists:answers,id', // Pour identifier les réponses existantes
        'answers.*.text' => 'sometimes|string',
        'answers.*.correct_one' => 'sometimes|boolean',
    ]);

    // Mettre à jour la question avec la traduction dans la langue par défaut
    if (isset($validatedData['text'])) {
        $question->update([
            'text' => $this->translationService->translate($validatedData['text'], $request->user()->locale, 'en'),
        ]);

        // Mettre à jour les traductions de la question
        $translations = [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            if ($lang !== $request->user()->locale) {
                $translations[$lang] = [
                    'text' => $this->translationService->translate($validatedData['text'], $request->user()->locale, $lang),
                ];
            }
        }
        $question->translations = $translations;
        $question->save();
    }

    // Gérer les réponses
    $existingAnswerIds = $question->answers->pluck('id')->toArray();
    $updatedAnswerIds = [];

    foreach ($validatedData['answers'] as $answerData) {
        $translations = [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            $translatedText = $this->translationService->translate($answerData['text'], $request->user()->locale, $lang);
            $translations[$lang] = $translatedText;
        }

        if (isset($answerData['id'])) {
            // Mettre à jour une réponse existante
            $answer = Answer::find($answerData['id']);
            if ($answer && $answer->question_id === $question->id) {
                $answer->update([
                    'text' => $translations['en'],  // Texte en anglais par défaut
                    'correct_one' => $answerData['correct_one'],
                    'translations' => $translations,  // Mettre à jour les traductions
                ]);
                $updatedAnswerIds[] = $answer->id;
            }
        } else {
            // Créer une nouvelle réponse
            $answer = Answer::create([
                'text' => $translations['en'],
                'correct_one' => $answerData['correct_one'],
                'question_id' => $question->id,
                'translations' => $translations,
            ]);
            $updatedAnswerIds[] = $answer->id;
        }
    }

    // Supprimer les réponses qui n'existent plus dans la mise à jour
    $answersToDelete = array_diff($existingAnswerIds, $updatedAnswerIds);
    if (!empty($answersToDelete)) {
        Answer::whereIn('id', $answersToDelete)->delete();
    }

    // Charger les relations mises à jour
    $question->load('answers');

    return response()->json([
        'message' => 'Question and answers updated successfully',
        'question' => $question,
    ], 200);
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
