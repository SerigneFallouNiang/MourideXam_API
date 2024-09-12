<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizzeRequest;
use App\Http\Requests\UpdateQuizzeRequest;
use App\Models\Quizze;

class QuizzeController extends Controller
{
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


    public function store(StoreQuizzeRequest $request)
    {
        $quiz = Quizze::create([
            'title' => $request->title,
            'chapter_id' => $request->chapter_id
        ]);

        return response()->json($quiz, 201);
    }

    /**
     * Display the specified resource.
     */

    // Obtenir un quiz spécifique
    public function show(Quizze $quiz)
    {

           // Affiche un quiz spécifique avec ses questions
           $quiz->load('questions');
           return response()->json($quiz, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quizze $quizze)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuizzeRequest $request, Quizze $quizze)
    {
        $quizze->update($request->validated());

        return response()->json(['message' => 'Quiz modifiée avec succès', 'Quiz' => $quizze], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quizze $quizze)
    {
         // Supprimer un quiz
         $quiz->delete();
         return response()->json(null, 204);
    }
}
