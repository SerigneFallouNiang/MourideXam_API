<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Quizze;
use App\Models\User_quiz_result;
use App\Notifications\QuizPassedNotification;
use App\Http\Requests\StoreUser_quiz_resultRequest;
use App\Http\Requests\UpdateUser_quiz_resultRequest;

class UserQuizResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser_quiz_resultRequest $request)
    {
        

         // Récupérer l'utilisateur connecté
         $user = auth()->user();

        // Valider la requête
        $validatedData = $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.answer_id' => 'required|exists:answers,id',
        ]);

        // Vérifier si l'utilisateur a déjà passé ce quiz
        $existingResult = User_quiz_result::where('user_id', $user->id)
        ->where('quiz_id', $validatedData['quiz_id'])
        ->first();

        // Trouver le quiz
        $quiz = Quizze::find($validatedData['quiz_id']);
        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz non trouvé'
            ], 404);
        }

        $score = 0;
        $totalQuestions = $quiz->questions()->count();

        foreach ($validatedData['answers'] as $answer) {
            $correctAnswer = Answer::where('question_id', $answer['question_id'])
                                  ->where('correct_one', true)
                                  ->first();

            // Comparer la réponse de l'utilisateur avec la réponse correcte
            if ($correctAnswer && $correctAnswer->id === $answer['answer_id']) {
                $score++;
            }

        
        }

        // Calculer le pourcentage
        $percentage = ($score / $totalQuestions) * 100;
        $isPassed = $percentage >= 70; // Par exemple, réussite si plus de 50%

        // Créer le résultat du quiz pour l'utilisateur
        $result = User_quiz_result::updateOrCreate(
            // 'user_id' => $validatedData['user_id'],
            // 'user_id' => $user->id,
            // 'quiz_id' => $validatedData['quiz_id'],
            // 'question_id' => $answer['question_id'],
            // 'answer_id' => $answer['answer_id'],
            // 'score' => $percentage,
            // 'is_passed' => $isPassed,
            [
                'user_id' => $user->id,
                'quiz_id' => $validatedData['quiz_id'],
            ],
            [
                'question_id' => $answer['question_id'],
                'answer_id' => $answer['answer_id'],
                'score' => $percentage,
                'is_passed' => $isPassed,
            ]
        );

          // Envoyer la notification de félicitations si l'utilisateur a réussi
    if ($isPassed) {
        // $user = User::find($validatedData['user_id']);
        
        // Envoyer la notification à l'utilisateur
        $user->notify(new QuizPassedNotification($user, $quiz, $score, $percentage));

        // Envoyer une notification à l'admin
        $admin = User::where('roles', 'apprenant')->first(); // Modifier cette ligne en fonction de ta structure utilisateur
        if ($admin) {
            $admin->notify(new QuizPassedNotification($user, $quiz, $score, $percentage));
        }

        return response()->json([
            'success' => true,
            'message' => 'Quiz result saved successfully',
            'result' => $result,
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'percentage' => $percentage,
            'is_passed' => $isPassed
        ], 201);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(User_quiz_result $user_quiz_result)
    {
          // Afficher un résultat spécifique
          return response()->json([
            'success' => true,
            'result' => $user_quiz_result
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser_quiz_resultRequest $request, User_quiz_result $user_quiz_result)
    {
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User_quiz_result $user_quiz_result)
    {
  
    }
}
