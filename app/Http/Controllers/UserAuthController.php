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
    ]);

    $user->update($request->only(['name', 'email', 'telephone']));

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
public function updateRole(Request $request, $id)
{
    $request->validate([
        'roleIdname' => 'required|exists:roles,id',
    ]);

    $user = User::findOrFail($id);
    
    // Synchroniser le nouveau rôle
    $user->syncRoles([$request->roleId]);

    return response()->json([
        'success' => true,
        'message' => 'Role updated successfully',
        'user' => $user->load('roles') // Charger les rôles mis à jour
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

    $books = Book::whereHas('chapters.userProgress', function ($query) use ($userId) {
        $query->where('user_id', $userId)
              ->whereIn('terminer', [1, 2]);
    })->get();

    return response()->json([
        'message' => 'Historique récupéré avec succès',
        'books' => $books
    ], 200);
}
}
