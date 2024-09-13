<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quizze;
use App\Models\User_quiz_result;
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
        
        // Valider la requête
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.answer_id' => 'required|exists:answers,id',
        ]);

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

            // Enregistrer la réponse de l'utilisateur
            User_quiz_result::create([
                'quiz_id' => $validatedData['quiz_id'],
                'user_id' => $validatedData['user_id'],
                'question_id' => $answer['question_id'],
                'answer_id' => $answer['answer_id'],
            ]);
        }

        // Calculer le pourcentage
        $percentage = ($score / $totalQuestions) * 100;
        $isPassed = $percentage >= 50; // Par exemple, réussite si plus de 50%

        // Créer le résultat du quiz pour l'utilisateur
        $result = User_quiz_result::create([
            'user_id' => $validatedData['user_id'],
            'quiz_id' => $validatedData['quiz_id'],
            'question_id' => $answer['question_id'],
            'answer_id' => $answer['answer_id'],
            'score' => $percentage,
            'is_passed' => $isPassed,
        ]);

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
