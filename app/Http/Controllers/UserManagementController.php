<?php

namespace App\Http\Controllers;

use App\Models\UserAuth;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    // ==================== USER CRUD ====================

    public function index()
    {
        $users = UserAuth::orderBy('id')->get();
        $roles = Role::orderBy('nama')->get();

        return view('users.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255|unique:global.user_auth,username',
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:global.user_auth,email',
                'password' => 'required|string|min:6',
                'role' => 'required|string',
                'status' => 'required|in:aktif,non-aktif',
            ]);

            $user = UserAuth::create([
                'username' => $validated['username'],
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => $validated['role'],
                'status' => $validated['status'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan',
                'data' => $user,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = UserAuth::findOrFail($id);

            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|string|min:6',
                'role' => 'required|string',
                'status' => 'required|in:aktif,non-aktif',
            ]);

            $data = [
                'username' => $validated['username'],
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'status' => $validated['status'],
            ];

            if (!empty($validated['password'])) {
                $data['password'] = $validated['password'];
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diupdate',
                'data' => $user,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = UserAuth::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ==================== ROLES CRUD ====================

    public function roles()
    {
        $roles = Role::withCount('userAuths')->withCount('permissions')->orderBy('id')->get();

        return view('roles.index', compact('roles'));
    }

    public function roleStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:global.roles,nama',
                'deskripsi' => 'nullable|string|max:500',
            ]);

            $role = Role::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Role berhasil ditambahkan',
                'data' => $role,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function roleUpdate(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);

            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:global.roles,nama,' . $id,
                'deskripsi' => 'nullable|string|max:500',
            ]);

            $role->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Role berhasil diupdate',
                'data' => $role,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function roleDestroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return response()->json([
                'success' => true,
                'message' => 'Role berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ==================== PERMISSIONS CRUD ====================

    public function permissions()
    {
        $permissions = Permission::orderBy('id')->get();

        return view('roles.permissions', compact('permissions'));
    }

    public function permissionStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'module' => 'required|string|max:255|unique:global.permissions,module',
                'read' => 'required|boolean',
                'create' => 'required|boolean',
                'update' => 'required|boolean',
                'delete' => 'required|boolean',
            ]);

            $permission = Permission::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Permission berhasil ditambahkan',
                'data' => $permission,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function permissionUpdate(Request $request, $id)
    {
        try {
            $permission = Permission::findOrFail($id);

            $validated = $request->validate([
                'module' => 'required|string|max:255|unique:global.permissions,module,' . $id,
                'read' => 'required|boolean',
                'create' => 'required|boolean',
                'update' => 'required|boolean',
                'delete' => 'required|boolean',
            ]);

            $permission->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Permission berhasil diupdate',
                'data' => $permission,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function permissionDestroy($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return response()->json([
                'success' => true,
                'message' => 'Permission berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ==================== ROLE-PERMISSION SYNC ====================

    public function rolePermissions(Request $request, $roleId)
    {
        try {
            $role = Role::findOrFail($roleId);
            $permissionIds = $request->input('permission_ids', []);

            $role->permissions()->sync($permissionIds);

            return response()->json([
                'success' => true,
                'message' => 'Permission untuk role berhasil diupdate',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
