<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser_quiz_resultRequest;
use App\Http\Requests\UpdateUser_quiz_resultRequest;
use App\Models\User_quiz_result;

class UserQuizResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lister tous les résultats d'un utilisateur
        $results = UserQuizResult::where('user_id', $userId)->get();
        return response()->json($results, 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser_quiz_resultRequest $request)
    {
        
        // Enregistrer le résultat d'un quiz
        $result = UserQuizResult::create($request->validated());
        return response()->json([
            'message' => 'Quiz result saved successfully',
            'data' => $result
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User_quiz_result $user_quiz_result)
    {
          // Afficher un résultat spécifique
          return response()->json($userQuizResult, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser_quiz_resultRequest $request, User_quiz_result $user_quiz_result)
    {
          // Mettre à jour le résultat d'un quiz
          $userQuizResult->update($request->validated());
          return response()->json([
              'message' => 'Quiz result updated successfully',
              'data' => $userQuizResult
          ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User_quiz_result $user_quiz_result)
    {
          // Supprimer un résultat de quiz
          $userQuizResult->delete();
          return response()->json([
              'message' => 'Quiz result deleted successfully'
          ], 204);
    }
}
