<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['store']]);
        $this->middleware('permission:role-edit', ['only' => ['update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    
    // Liste des rôles avec pagination
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'ASC')->paginate(5);
        return response()->json($roles, 200);
    }

    // Liste des permissions
    public function listPermission()
    {
        $permissions = Permission::all();
        return response()->json($permissions, 200);
    }

    // Enregistrer un rôle
   

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create($validatedData);
        $role->permissions()->sync($request->input('permissions'));

        return response()->json([
            'success' => true,
            'message' => 'Role add successfully',
            'role' => $role
        ], 200);
    }

    // Détail d'un rôle
    public function show($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return response()->json([
            'role' => $role,
            'permissions' => $rolePermissions
        ], 200);
    }



    public function update(Request $request, $id)
{
   

    try {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id, 
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json($e->errors(), 422);  // Voir les erreurs de validation
    }
    
    // dd($request->all()); 
    // Récupérer le rôle
    $role = Role::find($id);

    // Vérifier si le rôle existe
    if (!$role) {
        return response()->json(['error' => 'Role not found'], 404);
    }

       // Vérifier si le rôle a un ID 1, 2, 3 ou 4 (rôles par défaut)
       if (in_array($role->id, [1, 2, 3, 4])) {
        return response()->json(['error' => "Vous n'êtes pas autorisé à modifier ce rôle"], 403);
    }

    // Mettre à jour le rôle avec les données validées
    $role->update(['name' => $validatedData['name']]);

    // Synchroniser les permissions
    $role->permissions()->sync($request->input('permissions'));

    return response()->json([
        'success' => true,
        'message' => 'Role updated successfully',
        'role' => $role
    ], 200);
}


    // Suppression d'un rôle
    public function destroy($id)
    {
        //  dd($id->all()); 
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['erreur' => 'Rôle non trouvé'], 404);
        }

         // Vérifier si le rôle a un ID 1, 2, 3 ou 4 (rôles par défaut)
        if (in_array($role->id, [1, 2, 3, 4])) {
            return response()->json(['error' => "Vous n'êtes pas autorisé à supprimer ce rôle"], 403);
        }
    
        $role->delete();
        return response()->json(['message' => 'Rôle supprimé avec succès'], 200);
    }
}
