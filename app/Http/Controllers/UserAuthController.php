<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{



  

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
        "expires_in" => auth()->factory()->getTTL() * 60
    ]);
}

    public function logout(){
        auth()->user()->tokens()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ]);
    }
}
