<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;

class AnswerController extends Controller
{
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
    public function store(StoreAnswerRequest $request)
    {
         // Valider et créer une nouvelle réponse
         $validatedData = $request->validated();
         $answer = Answer::create($validatedData);
         return response()->json([
             'message' => 'Answer created successfully',
             'data' => $answer
         ], 201);
    }

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
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
           // Valider et mettre à jour une réponse
           $validatedData = $request->validated();
           $answer->update($validatedData);
           return response()->json([
               'message' => 'Answer updated successfully',
               'data' => $answer
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
