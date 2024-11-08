<?php

namespace App\Http\Controllers;
use App\Models\Book;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use App\Services\TranslationService;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{



protected $translationService;

public function __construct(TranslationService $translationService)
{
    $this->translationService = $translationService;
}

public function register(Request $request): JsonResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'telephone' => ['required', 'string', 'max:20'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'locale' => ['required', 'string']
    ]);

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'telephone' => $request->input('telephone'),
        'password' => Hash::make($request->input('password')),
         'locale' => $request->locale,
    ]);

    // Attribuer le rôle 'apprenant' par défaut
    $user->assignRole('apprenant');

    return response()->json([
        'message' => 'Utilisateur enregistré avec succès',
        'user' => $user,
    ], 201);
}

    


public function login(Request $request)
{
    // Validation des informations de connexion
    $request->validate([
        "email" => "required|email",
        "password" => "required"
    ]);

    // Authentification
    $token = auth()->attempt([
        "email" => $request->email,
        "password" => $request->password
    ]);

    if (!$token) {
        return response()->json([
            "status" => false,
            "message" => "Invalid login details"
        ]);
    }

    // Récupérer l'utilisateur authentifié
    $user = auth()->user();

    // Récupérer les rôles de l'utilisateur
    $roles = $user->getRoleNames(); 

    return response()->json([
        "status" => true,
        "message" => "User logged in successfully",
        "token" => $token,
        "token_type" => "bearer",
        "expires_in" => auth()->factory()->getTTL() * 60,
        "roles" => $roles,
        "user" => $user,
    ]);
}

public function updateProfile(Request $request): JsonResponse
{
    $user = auth()->user();

    $request->validate([
        'name' => ['sometimes', 'string', 'max:255'],
        'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'telephone' => ['sometimes', 'string', 'max:20'],
        'locale' => ['sometimes', 'string', 'in:fr,en,ar,wo'], // Validation de la langue
    ]);

    $user->update($request->only(['name', 'email', 'telephone', 'locale'])); // Mettre à jour le profil

    return response()->json([
        'status' => true,
        'message' => 'Profil mis à jour avec succès',
        'user' => $user
    ]);
}


// récupération des utilisateurs du platforme 
public function getAllUsers(): JsonResponse
{
    // Récupérer l'utilisateur authentifié
    $currentUser = auth()->user();

    // Récupérer tous les utilisateurs sauf celui qui est connecté
    $users = User::where('id', '!=', $currentUser->id)->with('roles')->get();

    return response()->json([
        'status' => true,
        'message' => 'Liste des utilisateurs sauf connecté',
        'users' => $users
    ]);
}




  // Profile API - GET (JWT Auth Token)
  public function profile(){

    //$userData = auth()->user();
    $userData = request()->user();

    return response()->json([
        "status" => true,
        "message" => "Profile data",
        "data" => $userData,
        //"user_id" => request()->user()->id,
        //"email" => request()->user()->email
    ]);
}

// Refresh Token API - GET (JWT Auth Token)
public function refreshToken(){

    $token = auth()->refresh();

    return response()->json([
        "status" => true,
        "message" => "New access token",
        "token" => $token,
        // "expires_in" => auth()->factory()->getTTL() * 60
    ]);
}

    public function logout(){
        auth()->user()->tokens()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ]);
    }


    // Traduction multilangue 
    public function setLanguage(Request $request)
    {
        $validatedData = $request->validate([
            'language' => 'required|string|in:fr,en,ar,wo',
        ]);

        $user = $request->user();
        $user->locale = $validatedData['language'];
        $user->save();

        return response()->json(['message' => 'Language updated successfully']);
    }

    public function getSupportedLanguages()
    {
        return response()->json($this->translationService->getSupportedLanguages());
    }

    public function getUserCount(): JsonResponse
{
    // Compter le nombre d'utilisateurs
    $userCount = User::count();

    return response()->json([
        'status' => true,
        'message' => 'Total number of users',
        'user_count' => $userCount
    ]);
}

//modification des roles 
// public function updateRole(Request $request, $id)
// {
//     $request->validate([
//         'roleIdname' => 'required|exists:roles,id',
//     ]);

//     $user = User::findOrFail($id);
    
//     // Synchroniser le nouveau rôle
//     $user->syncRoles([$request->roleId]);

//     return response()->json([
//         'success' => true,
//         'message' => 'Role updated successfully',
//         'user' => $user->load('roles') // Charger les rôles mis à jour
//     ]);
// }

public function updateRole(Request $request, $id)
{
    $request->validate([
        'roleId' => 'required|exists:roles,id',  // Changé de 'roleIdname' à 'roleId'
    ]);
    
    $user = User::findOrFail($id);
    $user->syncRoles([$request->roleId]);  // Maintenant ça correspond
    
    return response()->json([
        'success' => true,
        'message' => 'Role updated successfully',
        'user' => $user->load('roles')
    ]);
}



//pour voir l'history d'un utilisateur
public function getBooksWithReadChaptersByUser($userId)
{
    $user = User::find($userId);
    
    if (!$user) {
        return response()->json([
            'message' => 'Utilisateur non trouvé',
        ], 404);
    }
    // Récupérer tous les livres qui ont au moins un chapitre avec un quiz terminé par cet utilisateur
    $books = Book::whereHas('chapters.quiz.quizResults', function ($query) use ($userId) {
        $query->where('user_id', $userId)
              ->whereIn('terminer', [1, 2]); // Condition pour les quiz terminés ou lus par cet utilisateur
    })->with(['chapters.quiz' => function ($query) use ($userId) {
        // Charger les résultats de quiz pour calculer le pourcentage de progression
        $query->withCount(['quizResults as completed_count' => function ($query) use ($userId) {
            $query->where('user_id',$userId)
                  ->where('terminer', 1); // Seulement les quiz terminés
        }]);
    }])->get();

    // Si aucun livre n'est trouvé
    if ($books->isEmpty()) {
        return response()->json([
            'message' => 'Aucun livre avec des chapitres terminés trouvé pour cet utilisateur',
            'books' => []
        ], 200);
    }

    // Préparer les livres avec le pourcentage de progression
    $booksWithProgress = $books->map(function ($book) {
        $totalChapters = $book->chapters->count(); // Nombre total de chapitres
        $completedChapters = $book->chapters->sum('quiz.completed_count'); // Nombre de chapitres/quiz terminés
        $progress = $totalChapters > 0 ? round(($completedChapters / $totalChapters) * 100, 2) : 0; // Calcul du pourcentage

       
        return [
            'id' => $book->id,
            'title' => $book->title,
            'image' => $book->image,
            'description' => $book->description,
            'category_id' => $book->category_id,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
            'translations' => $book->translations, // Assurez-vous que le champ `translations` est bien défini
            'total_chapters' => $totalChapters,
            'completed_chapters' => $completedChapters,
            'progress' => $progress // Pourcentage de progression
        ];
    });

    // Retourner les livres avec le pourcentage de progression
    return response()->json([
        'message' => 'Livres avec progression des chapitres terminés récupérés avec succès pour l\'utilisateur',
        'books' => $booksWithProgress
    ], 200);
}
}
