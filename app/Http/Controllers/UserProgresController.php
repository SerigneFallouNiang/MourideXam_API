<?php

namespace App\Http\Controllers;

use App\Models\User_progres;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUser_progresRequest;
use App\Http\Requests\UpdateUser_progresRequest;

class UserProgresController extends Controller
{


    public function getUserProgress(Request $request)
    {
        $user = Auth::user(); // Obtenir l'utilisateur authentifié
        
        // Récupérer tous les progrès de l'utilisateur
        $userProgress = User_progres::where('user_id', $user->id)
            ->where('is_completed', true)
            ->with('chapter.book')
            ->get();

        // Structurer les données
        $progressData = [];
        foreach ($userProgress as $progress) {
            $bookId = $progress->chapter->book->id;
            $chapterId = $progress->chapter_id;

            if (!isset($progressData[$bookId])) {
                $progressData[$bookId] = [
                    'book_id' => $bookId,
                    'book_title' => $progress->chapter->book->title,
                    'chapters' => []
                ];
            }

            $progressData[$bookId]['chapters'][] = [
                'chapter_id' => $chapterId,
                'chapter_title' => $progress->chapter->title,
                'completed_at' => $progress->updated_at
            ];
        }

        return response()->json([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'progress' => array_values($progressData)
        ]);
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser_progresRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User_progres $user_progres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User_progres $user_progres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser_progresRequest $request, User_progres $user_progres)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User_progres $user_progres)
    {
        //
    }
}
