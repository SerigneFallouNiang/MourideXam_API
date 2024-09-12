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
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
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
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array',
        ]);

        $permissionsID = array_map(function($value) {
            return (int) $value;
        }, $request->input('permission'));

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($permissionsID);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully',
            'role' => $role
        ], 201);
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

    // Mise à jour d'un rôle
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required|array',
        ]);

        $role = Role::find($id);

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        $role->name = $request->input('name');
        $role->save();

        $permissionsID = array_map(function($value) {
            return (int) $value;
        }, $request->input('permission'));

        $role->syncPermissions($permissionsID);

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully',
            'role' => $role
        ], 200);
    }

    // Suppression d'un rôle
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}