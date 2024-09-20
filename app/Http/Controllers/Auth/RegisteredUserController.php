<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:20'],
            'progress' => ['nullable', 'string', 'max:20'],  // Progress peut être facultatif
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
            'progress' => $request->input('progress'),
            'password' => Hash::make($request->input('password')),
        ]);


        // Attribuer le rôle 'apprenant' par défaut
        $user->assignRole('apprenant');

        event(new Registered($user));

        // Optionnel: connexion automatique de l'utilisateur après enregistrement
        // Auth::login($user);

        return response()->json([
            'message' => 'Utilisateur enregistré avec succès',
            'user' => $user
        ], 201);
    }


    public function update(Request $request): JsonResponse
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = Auth::user();
    
        // Valider la requête
        $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'telephone' => ['sometimes', 'string', 'max:20'],
            'progress' => ['nullable', 'string', 'max:20'], // Facultatif
            'email' => ['sometimes', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['sometimes', 'confirmed', 'min:8'], // La confirmation de mot de passe est nécessaire si modifié
        ]);
    
        // Mettre à jour uniquement les champs fournis dans la requête
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('telephone')) {
            $user->telephone = $request->input('telephone');
        }
        if ($request->has('progress')) {
            $user->progress = $request->input('progress');
        }
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    
        // Sauvegarder les modifications
        $user->save();
    
        return response()->json([
            'message' => 'Profil mis à jour avec succès',
            'user' => $user
        ], 200);
    }
    
}
