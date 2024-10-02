<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Services\TranslationService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;

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
    ]);

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'telephone' => $request->input('telephone'),
        'password' => Hash::make($request->input('password')),
        'locale' => 'fr', // Définir la langue par défaut à 'fr'
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
}
