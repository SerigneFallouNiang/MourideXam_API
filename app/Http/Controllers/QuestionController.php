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
    try {
        // Validation des données de la question et des réponses
        $validatedData = $request->validate([
            'text' => 'required|string',
            'answers' => 'required|array',
            'answers.*.text' => 'required|string',
            'answers.*.correct_one' => 'required|boolean',
        ]);

        // Créer la question
        $question = Question::create([
            'text' => $validatedData['text'],
        ]);

        $answers = [];
        // Créer les réponses avec leurs traductions
        foreach ($validatedData['answers'] as $answerData) {
            // Générer les traductions pour chaque réponse
            $translations = [];
            foreach ($this->translationService->getSupportedLanguages() as $lang) {
                if ($lang !== $request->user()->locale) {
                    $translations[$lang] = [
                        'text' => $this->translationService->translate(
                            $answerData['text'],
                            $lang,
                            $request->user()->locale
                        ),
                    ];
                }
            }

            // Créer la réponse avec ses traductions
            $answer = Answer::create([
                'text' => $answerData['text'],
                'correct_one' => $answerData['correct_one'],
                'question_id' => $question->id,
                'translations' => $translations,
            ]);

            $answers[] = $answer;
        }

        // Traduire la question dans les autres langues supportées
        $translations = [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            if ($lang !== $request->user()->locale) {
                $translations[$lang] = [
                    'text' => $this->translationService->translate(
                        $question->text,
                        $lang,
                        $request->user()->locale
                    ),
                ];
            }
        }

        // Sauvegarder les traductions de la question
        $question->translations = $translations;
        $question->save();

        return response()->json([
            'success' => true,
            'message' => 'Question et réponses créées avec succès',
            'question' => $question,
            'answers' => $answers
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la création de la question',
            'error' => $e->getMessage(),
        ], 500);
    }
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
//     
public function update(UpdateQuestionRequest $request, Question $question)
{
    try {
        // Validation des données
        $validatedData = $request->validate([
            'text' => 'sometimes|string',
            'answers' => 'sometimes|array',
            'answers.*.id' => 'nullable|exists:answers,id',
            'answers.*.text' => 'required_without:answers.*.id|string',
            'answers.*.correct_one' => 'required_without:answers.*.id|boolean',
        ]);

        // Mise à jour de la question si le texte est fourni
        if (isset($validatedData['text'])) {
            $question->update([
                'text' => $validatedData['text'],
            ]);

            // Mettre à jour les traductions de la question
            $translations = [];
            foreach ($this->translationService->getSupportedLanguages() as $lang) {
                if ($lang !== $request->user()->locale) {
                    $translations[$lang] = [
                        'text' => $this->translationService->translate(
                            $validatedData['text'],
                            $lang,
                            $request->user()->locale
                        ),
                    ];
                }
            }
            
            $question->translations = $translations;
            $question->save();
        }

        // Mise à jour des réponses si fournies
        if (isset($validatedData['answers'])) {
            $existingAnswerIds = $question->answers->pluck('id')->toArray();
            $updatedAnswerIds = [];

            foreach ($validatedData['answers'] as $answerData) {
                // Générer les traductions pour la réponse
                $translations = [];
                foreach ($this->translationService->getSupportedLanguages() as $lang) {
                    if ($lang !== $request->user()->locale) {
                        $translations[$lang] = [
                            'text' => $this->translationService->translate(
                                $answerData['text'],
                                $lang,
                                $request->user()->locale
                            ),
                        ];
                    }
                }

                if (isset($answerData['id'])) {
                    // Mise à jour d'une réponse existante
                    $answer = Answer::find($answerData['id']);
                    if ($answer && $answer->question_id === $question->id) {
                        $answer->update([
                            'text' => $answerData['text'],
                            'correct_one' => $answerData['correct_one'] ?? $answer->correct_one,
                            'translations' => $translations,
                        ]);
                        $updatedAnswerIds[] = $answer->id;
                    }
                } else {
                    // Création d'une nouvelle réponse
                    $answer = Answer::create([
                        'text' => $answerData['text'],
                        'correct_one' => $answerData['correct_one'],
                        'question_id' => $question->id,
                        'translations' => $translations,
                    ]);
                    $updatedAnswerIds[] = $answer->id;
                }
            }

            // Supprimer les réponses qui ne sont plus présentes
            if (!empty($existingAnswerIds)) {
                Answer::whereIn('id', array_diff($existingAnswerIds, $updatedAnswerIds))
                    ->where('question_id', $question->id)
                    ->delete();
            }
        }

        // Recharger la question avec ses réponses
        $question->load('answers');

        return response()->json([
            'success' => true,
            'message' => 'Question et réponses mises à jour avec succès',
            'question' => $question,
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la mise à jour de la question',
            'error' => $e->getMessage(),
        ], 500);
    }
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
