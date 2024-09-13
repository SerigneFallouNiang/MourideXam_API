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
        // $quiz = Quizze::create([
        //     'title' => $request->title,
        //     'chapter_id' => $request->chapter_id
        // ]);

        // return response()->json($quiz, 201);

        // $validatedData = $request->validate([
        //     'title' => 'required|string|max:255|unique:roles,name',
        //     'chapter_id' => 'required|array',
        //     'questions.*' => 'exists:questions,id',
        // ]);

        // $quiz = Quizze::create($validatedData);
        // $quiz->permissions()->sync($request->input('questions'));

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Question add successfully',
        //     'question' => $quiz
        // ], 200);

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

        // Assigner les questions au quiz
        $quiz->questions()->sync($validatedData['questions']);

        return response()->json([
            'success' => true,
            'message' => 'Quiz créé avec succès et questions assignées',
            'quiz' => $quiz->load('questions')  // Charger les questions associées
        ], 201);
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
    public function update(UpdateQuizzeRequest $request, Quizze $quizze)
    {
        // Mettre à jour le quiz
        $quizze->update($request->validated());

        // Mettre à jour les questions du quiz si fournies
        if ($request->has('questions')) {
            $quizze->questions()->sync($request->input('questions'));
        }

        return response()->json([
            'message' => 'Quiz modifié avec succès',
            'quiz' => $quizze->load('questions')
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
}
