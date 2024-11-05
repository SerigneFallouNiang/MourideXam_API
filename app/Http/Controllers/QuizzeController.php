<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Answer;
use App\Models\Quizze;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\QuizResult;
use App\Models\User_progres;
use Illuminate\Http\Request;
use App\Models\QuizUserAnswer;
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




//récupération des quizs avec leurs chapitres
public function getQuizzesWithChapters()
{
    $quizzes = Quizze::with('chapter')->get();
    
    return response()->json([
        'success' => true,
        'data' => $quizzes
    ], 200);
}








//pour faire un quiz
public function submitQuiz(Request $request, $quizId)
{
    $quiz = Quizze::findOrFail($quizId);
    $user = Auth::user();

    // Vérifiez si l'utilisateur est authentifié
    if (!$user) {
        return response()->json([
            'message' => $this->translationService->translate('Utilisateur non authentifié', $user->locale),
        ], 401);
    }

    // Vérifier si l'utilisateur a déjà passé ce quiz dans les dernières 24 heures
    $lastAttempt = QuizResult::where('user_id', $user->id)
                             ->where('quiz_id', $quizId)
                             ->latest()
                             ->first();

    if ($lastAttempt && $lastAttempt->created_at->addHours(24) > now()) {
        $timeLeft = $lastAttempt->created_at->addHours(24)->diffForHumans(now());
        return response()->json([
            'message' => $this->translationService->translate("Vous devez attendre encore {$timeLeft} avant de pouvoir repasser ce quiz.", $user->locale),
        ], 403);
    }

    $validatedData = $request->validate([
        'answers' => 'required|array',
        'answers.*.question_id' => 'required|exists:questions,id',
        'answers.*.answer_id' => 'required|exists:answers,id',
    ]);

    $correctAnswers = 0;
    $totalQuestions = count($validatedData['answers']);
    $detailedResults = [];

    // Préparer une requête pour récupérer toutes les réponses correctes à l'avance
    $questions = Question::with('answers')->findMany(collect($validatedData['answers'])->pluck('question_id'));

    foreach ($validatedData['answers'] as $answer) {
        $question = $questions->where('id', $answer['question_id'])->first();
        $correctAnswer = $question->answers->where('correct_one', true)->first();
        $allAnswers = $question->answers;

        $isCorrect = $correctAnswer && $correctAnswer->id == $answer['answer_id'];
        if ($isCorrect) {
            $correctAnswers++;
        }

        $detailedResults[] = [
            'question' => [
                'id' => $question->id,
                'text' => $this->translationService->translate($question->text, $user->locale),
            ],
            'answers' => $allAnswers->map(function ($ans) use ($correctAnswer, $answer, $user) {
                return [
                    'id' => $ans->id,
                    'text' => $this->translationService->translate($ans->text, $user->locale),
                    'is_correct' => $ans->id === $correctAnswer->id,
                    'user_selected' => $ans->id === $answer['answer_id'],
                ];
            }),
            'is_correct' => $isCorrect,
        ];
    }

    $score = ($correctAnswers / $totalQuestions) * 100;
    $isPassed = $score >= 70;  // Note de passage à 70%

    // Créer un nouveau résultat de quiz
    $quizResult = QuizResult::create([
        'user_id' => $user->id,
        'quiz_id' => $quizId,
        'terminer' => $isPassed ? '1' : '2',
        'score' => $score,
        'answers' => json_encode($detailedResults),
        'is_passed' => $isPassed,
    ]);

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
        'message' => $this->translationService->translate('Quiz terminé', $user->locale),
        'user_id' => $user->id,
        'chapter_id' => $quiz->chapter_id,
        'score' => $score,
        'correctAnswers' => $correctAnswers,
        'totalQuestions' => $totalQuestions,
        'isPassed' => $isPassed,
        'detailedResults' => $detailedResults,
    ]);
}



//pour récupérer les information d'un quiz déja passer
public function showPassedQuiz($quizId)
{
    $user = Auth::user();

    // Vérifier si l'utilisateur est authentifié
    if (!$user) {
        return response()->json([
            'message' => $this->translationService->translate('Utilisateur non authentifié', $user->locale),
        ], 401);
    }

    // Récupérer les résultats du quiz passé
    $quizResult = QuizResult::where('user_id', $user->id)
                            ->where('quiz_id', $quizId)
                            ->latest()
                            ->first();

    // Vérifier si l'utilisateur a déjà passé ce quiz
    if (!$quizResult) {
        return response()->json([
            'message' => $this->translationService->translate('Aucun résultat trouvé pour ce quiz', $user->locale),
        ], 404);
    }

    // Décoder les réponses stockées en JSON
    $userAnswers = json_decode($quizResult->answers, true);

    $detailedResults = [];

    foreach ($userAnswers as $answer) {
        $detailedResults[] = [
            'question' => [
                'id' => $answer['question']['id'],
                'text' => $this->translationService->translate($answer['question']['text'], $user->locale),
            ],
            'answers' => collect($answer['answers'])->map(function ($ans) use ($user) {
                return [
                    'id' => $ans['id'],
                    'text' => $this->translationService->translate($ans['text'], $user->locale),
                    'is_correct' => $ans['is_correct'],
                    'user_selected' => $ans['user_selected'],
                ];
            }),
            'is_correct' => $answer['is_correct'],
        ];
    }

    // Retourner les résultats détaillés avec les questions et les réponses sélectionnées
    return response()->json([
        'message' => $this->translationService->translate('Résultats du quiz', $user->locale),
        'quiz_id' => $quizResult->quiz_id,
        'score' => $quizResult->score,
        'is_passed' => $quizResult->is_passed,
        'detailedResults' => $detailedResults,
    ]);
}

//pour la disponiblité du quiz
public function checkLastAttempt($quizId)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json([
            'message' => $this->translationService->translate('Utilisateur non authentifié', $user->locale),
        ], 401);
    }

    $lastAttempt = QuizResult::where('user_id', $user->id)
        ->where('quiz_id', $quizId)
        ->latest()
        ->first();

    if ($lastAttempt && $lastAttempt->created_at->addHours(24) > now()) {
        // L'utilisateur doit encore attendre
        $timeLeft = $lastAttempt->created_at->addHours(24)->diffForHumans(now());
        return response()->json([
            'canRetake' => false,
            'timeLeft' => $timeLeft,
            'message' => $this->translationService->translate("Vous devez attendre encore {$timeLeft} avant de pouvoir repasser ce quiz.", $user->locale),
        ]);
    }

    // L'utilisateur peut reprendre le quiz
    return response()->json([
        'canRetake' => true,
        'message' => $this->translationService->translate("Vous pouvez passer le quiz maintenant.", $user->locale),
    ]);
}
}
