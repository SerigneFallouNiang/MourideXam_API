<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Answer;
use App\Models\Quizze;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\User_progres;
use Illuminate\Http\Request;
use App\Services\TranslationService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreQuizzeRequest;
use App\Http\Requests\UpdateQuizzeRequest;
use App\Notifications\QuizPassedNotification;

class QuizzeController extends Controller
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

      // Lister tous les quiz pour un chapitre
    public function index($chapterId)
    {
        $quizzes = Quizze::where('chapter_id', $chapterId)->get();
        return response()->json($quizzes);
    }

   

    /**
     * Store a newly created resource in storage.
     */


    // public function store(StoreQuizzeRequest $request)
    // {
    //     try {
    //           // Validation des données du quiz
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255|unique:quizzes,title',
    //         'chapter_id' => 'required|exists:chapters,id',
    //         'questions' => 'required|array',
    //         'questions.*' => 'exists:questions,id',
    //     ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return response()->json($e->errors(), 422);  // Voir les erreurs de validation
    //     }

      

    //     // Créer le quiz
    //     $quiz = Quizze::create([
    //         'title' => $validatedData['title'],
    //         'chapter_id' => $validatedData['chapter_id'],
    //     ]);


        
    //     // Assigner les questions au quiz
    //     $quiz->questions()->sync($validatedData['questions']);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Quiz créé avec succès et questions assignées',
    //         'quiz' => $quiz->load('questions')  // Charger les questions associées
    //     ], 201);
    // }


    public function store(StoreQuizzeRequest $request)
{
    try {
        // Validation des données du quiz
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:quizzes,title',
            'chapter_id' => 'required|exists:chapters,id',
            'questions' => 'required|array',
            'questions.*' => 'exists:questions,id',
        ]);

        // Créer le quiz
        $quiz = Quizze::create([
            'title' => $validatedData['title'],
            'chapter_id' => $validatedData['chapter_id'],
        ]);

        // Traduire le titre dans les autres langues supportées
        $translations = [];
        foreach ($this->translationService->getSupportedLanguages() as $lang) {
            if ($lang !== $request->user()->locale) {
                $translations[$lang] = [
                    'title' => $this->translationService->translate($quiz->title, $lang, $request->user()->locale),
                ];
            }
        }

        // Assigner les traductions au quiz (si votre modèle supporte les traductions)
        $quiz->translations = $translations;
        $quiz->save();  // Sauvegarder les traductions dans la base de données si nécessaire

        // Assigner les questions au quiz
        $quiz->questions()->sync($validatedData['questions']);

        // Retourner une réponse avec le quiz et ses questions
        return response()->json([
            'success' => true,
            'message' => 'Quiz créé avec succès et questions assignées',
            'quiz' => $quiz->load('questions')  // Charger les questions associées
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Retourner les erreurs de validation
        return response()->json([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        // Gestion des autres erreurs
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la création du quiz',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */

    // Obtenir un quiz spécifique
    public function show(Quizze $quizze)
    {
        // Affiche un quiz spécifique avec ses questions
        $quizze->load('questions');
        return response()->json($quizze, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateQuizzeRequest $request, Quizze $quizze)
    // {
    //     // Mettre à jour le quiz
    //     $quizze->update($request->validated());

    //     // Mettre à jour les questions du quiz si fournies
    //     if ($request->has('questions')) {
    //         $quizze->questions()->sync($request->input('questions'));
    //     }
        

    //     return response()->json([
    //         'message' => 'Quiz modifié avec succès',
    //         'quiz' => $quizze->load('questions')
    //     ], 200);
    // }

    public function update(UpdateQuizzeRequest $request, Quizze $quizze)
{
    // Mettre à jour le quiz
    $quizze->update($request->validated());

    // Mettre à jour les questions du quiz si fournies
    if ($request->has('questions')) {
        $quizze->questions()->sync($request->input('questions'));
    }

    // Mettre à jour les traductions
    $translations = $quizze->translations ?? [];  // Utilisez $quizze au lieu de $category
    foreach ($this->translationService->getSupportedLanguages() as $lang) {
        if ($lang !== $request->user()->locale) {
            $translations[$lang] = [
                'title' => $this->translationService->translate($quizze->title, $lang, $request->user()->locale),
                // Si vous avez une description à traduire, ajoutez-la ici
                // 'description' => $this->translationService->translate($quizze->description, $lang, $request->user()->locale),
            ];
        }
    }

    // Assigner les traductions au quiz
    $quizze->translations = $translations;
    $quizze->save();  // Sauvegarder les traductions dans la base de données

    return response()->json([
        'message' => 'Quiz modifié avec succès',
        'quiz' => $quizze->load('questions')  // Charger les questions associées
    ], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quizze $quizze)
    {
        // Supprimer le quiz et ses relations
        $quizze->questions()->detach();  // Détacher les questions avant de supprimer
        $quizze->delete();

        return response()->json(['message' => 'Quiz supprimé avec succès'], 204);
    }



// Passer quiz pour un utilisateur 
    // public function startQuiz($chapterId)
    // {
    //     $chapter = Chapter::findOrFail($chapterId);
    //     $quiz = $chapter->quiz;

    //     if (!$quiz) {
    //         return response()->json(['message' => 'Aucun quiz disponible pour ce chapitre.'], 404);
    //     }

    //     $questions = $quiz->questions()->inRandomOrder()->get();

    //     $questionsWithAnswers = $questions->map(function ($question) {
    //         return [
    //             'id' => $question->id,
    //             'text' => $question->text,
    //             'answers' => $question->answers->map(function ($answer) {
    //                 return [
    //                     'id' => $answer->id,
    //                     'text' => $answer->text
    //                 ];
    //             })
    //         ];
    //     });

    //     return response()->json([
    //         'quiz' => [
    //             'id' => $quiz->id,
    //             'title' => $quiz->title,
    //         ],
    //         'questions' => $questionsWithAnswers
    //     ]);
    // }

    public function startQuiz($chapterId)
{
    // Récupérer l'utilisateur authentifié
    $user = Auth::user();
    
    // Définir la locale, soit celle de l'utilisateur, soit la locale par défaut
    $locale = $user ? $user->locale : config('app.locale');

    // Récupérer le chapitre et le quiz associé
    $chapter = Chapter::findOrFail($chapterId);
    $quiz = $chapter->quiz;

    if (!$quiz) {
        return response()->json(['message' => 'Aucun quiz disponible pour ce chapitre.'], 404);
    }

    // Récupérer les questions dans un ordre aléatoire
    $questions = $quiz->questions()->inRandomOrder()->get();

    // Formater les questions avec les réponses et effectuer la traduction
    $questionsWithAnswers = $questions->map(function ($question) use ($locale) {
        return [
            'id' => $question->id,
            'text' => $this->translationService->translate($question->text, $locale), // Traduire la question
            'answers' => $question->answers->map(function ($answer) use ($locale) {
                return [
                    'id' => $answer->id,
                    'text' => $this->translationService->translate($answer->text, $locale), // Traduire la réponse
                ];
            })
        ];
    });

    // Retourner le quiz avec le titre traduit
    return response()->json([
        'quiz' => [
            'id' => $quiz->id,
            'title' => $this->translationService->translate($quiz->title, $locale), // Traduire le titre du quiz
        ],
        'questions' => $questionsWithAnswers
    ]);
}


   

// public function submitQuiz(Request $request, $quizId)
// {
//     $quiz = Quizze::findOrFail($quizId);
//     $user = Auth::user();

//       // Vérifiez si l'utilisateur est authentifié
//       if (!$user) {
//         return response()->json([
//             'message' => 'Utilisateur non authentifié',
//         ], 401);
//     }

//     $validatedData = $request->validate([
//         'answers' => 'required|array',
//         'answers.*.question_id' => 'required|exists:questions,id',
//         'answers.*.answer_id' => 'required|exists:answers,id',
//     ]);

//     $correctAnswers = 0;
//     $totalQuestions = count($validatedData['answers']);
//     $detailedResults = [];

//     foreach ($validatedData['answers'] as $answer) {
//         $question = Question::findOrFail($answer['question_id']);
//         $correctAnswer = $question->answers()->where('correct_one', true)->first();
//         $allAnswers = $question->answers;

//         $isCorrect = $correctAnswer && $correctAnswer->id == $answer['answer_id'];
//         if ($isCorrect) {
//             $correctAnswers++;
//         }

//         $detailedResults[] = [
//             'question' => [
//                 'id' => $question->id,
//                 'text' => $question->text,
//             ],
//             'answers' => $allAnswers->map(function ($ans) use ($correctAnswer, $answer) {
//                 return [
//                     'id' => $ans->id,
//                     'text' => $ans->text,
//                     'is_correct' => $ans->id === $correctAnswer->id,
//                     'user_selected' => $ans->id === $answer['answer_id'],
//                 ];
//             }),
//             'is_correct' => $isCorrect,
//         ];
//     }

//     $score = ($correctAnswers / $totalQuestions) * 100;
//     // Considérons que 70% est la note de passage
//     $isPassed = $score >= 70; 

//     //  // Mettre à jour l'état du chapitre en fonction du résultat du quiz
//     //  $chapter = User_progres::findOrFail($quiz->user_id);
//     //  $chapter->terminer = $isPassed ? 1 : 2; // 1 si réussi, 2 si échoué
//     //  $chapter->save();
     

//     // Mise à jour du quiz avec le score et le statut
//     $quiz->update([
//         'score' => $score,
//         'is_passed' => $isPassed,
//     ]);

//     // // Mise à jour du progrès de l'utilisateur
//     // $userProgress =  User_progres::updateOrCreate(
//     //     ['user_id' => $user->id, 'chapter_id' => $quiz->chapter_id],
//     //     ['is_completed' => $isPassed]
//     // );
//        // Mise à jour ou création du progrès de l'utilisateur pour ce chapitre
//        $userProgress = User_progres::updateOrCreate(
//         [
//             'user_id' => $user->id, 
//             'chapter_id' => $quiz->chapter_id
//         ], 
//         [
//             'is_completed' => $isPassed,
//             'terminer' => $isPassed ? '1' : '2'  // 1 pour réussi, 2 pour échoué
//         ]
//     );

//     // Envoyer des notifications si nécessaire
//     if ($isPassed) {
//         $user->notify(new QuizPassedNotification($user, $quiz, $correctAnswers, $score));
        
//         $admin = User::role('admin')->first();
//         if ($admin) {
//             $admin->notify(new QuizPassedNotification($user, $quiz, $correctAnswers, $score));
//         }
//     }

//       // Retourner une réponse JSON avec les résultats
//       return response()->json([
//         'message' => 'Quiz terminé',
//         'user_id' => $user->id,  // ID de l'utilisateur pour traçabilité
//         'chapter_id' => $quiz->chapter_id,  // ID du chapitre
//         'score' => $score,  // Score obtenu
//         'correctAnswers' => $correctAnswers,  // Nombre de réponses correctes
//         'totalQuestions' => $totalQuestions,  // Nombre total de questions
//         'isPassed' => $isPassed,  // Statut de passage ou échec
//         'detailedResults' => $detailedResults,  // Détails des réponses
//     ]);
// }


public function submitQuiz(Request $request, $quizId)
{
    $quiz = Quizze::findOrFail($quizId);
    $user = Auth::user();

    // Vérifiez si l'utilisateur est authentifié
    if (!$user) {
        return response()->json([
            'message' => $this->translationService->translate('Utilisateur non authentifié', $user->locale),  // Traduction
        ], 401);
    }

    $validatedData = $request->validate([
        'answers' => 'required|array',
        'answers.*.question_id' => 'required|exists:questions,id',
        'answers.*.answer_id' => 'required|exists:answers,id',
    ]);

    $correctAnswers = 0;
    $totalQuestions = count($validatedData['answers']);
    $detailedResults = [];

    foreach ($validatedData['answers'] as $answer) {
        $question = Question::findOrFail($answer['question_id']);
        $correctAnswer = $question->answers()->where('correct_one', true)->first();
        $allAnswers = $question->answers;

        $isCorrect = $correctAnswer && $correctAnswer->id == $answer['answer_id'];
        if ($isCorrect) {
            $correctAnswers++;
        }

        $detailedResults[] = [
            'question' => [
                'id' => $question->id,
                'text' => $this->translationService->translate($question->text, $user->locale),  // Traduction de la question
            ],
            'answers' => $allAnswers->map(function ($ans) use ($correctAnswer, $answer, $user) {
                return [
                    'id' => $ans->id,
                    'text' => $this->translationService->translate($ans->text, $user->locale),  // Traduction des réponses
                    'is_correct' => $ans->id === $correctAnswer->id,
                    'user_selected' => $ans->id === $answer['answer_id'],
                ];
            }),
            'is_correct' => $isCorrect,
        ];
    }

    $score = ($correctAnswers / $totalQuestions) * 100;
    $isPassed = $score >= 70;  // Note de passage à 70%

    // Mise à jour ou création du progrès de l'utilisateur pour ce chapitre
    $userProgress = User_progres::updateOrCreate(
        [
            'user_id' => $user->id, 
            'chapter_id' => $quiz->chapter_id
        ], 
        [
            'is_completed' => $isPassed,
            'terminer' => $isPassed ? '1' : '2'  // 1 pour réussi, 2 pour échoué
        ]
    );

    // Envoyer des notifications si nécessaire
    if ($isPassed) {
        $user->notify(new QuizPassedNotification($user, $quiz, $correctAnswers, $score));
        
        $admin = User::role('admin')->first();
        if ($admin) {
            $admin->notify(new QuizPassedNotification($user, $quiz, $correctAnswers, $score));
        }
    }

    // Retourner une réponse JSON avec les résultats, incluant les traductions
    return response()->json([
        'message' => $this->translationService->translate('Quiz terminé', $user->locale),  // Traduction du message
        'user_id' => $user->id,  // ID de l'utilisateur pour traçabilité
        'chapter_id' => $quiz->chapter_id,  // ID du chapitre
        'score' => $score,  // Score obtenu
        'correctAnswers' => $correctAnswers,  // Nombre de réponses correctes
        'totalQuestions' => $totalQuestions,  // Nombre total de questions
        'isPassed' => $isPassed,  // Statut de passage ou échec
        'detailedResults' => $detailedResults,  // Détails des réponses
    ]);
}

}
