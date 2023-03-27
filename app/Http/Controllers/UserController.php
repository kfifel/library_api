<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function updatePassword()
    {

    }

    public function updateProfile()
    {

    }


    public function assignRole(Request $request): JsonResponse
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'user_id' => 'required|exists:users,id',
        ]);
        try {

            $role = Role::findOrFail($request->role_id);
            $user = User::findOrFail($request->user_id);

            if ($user->hasRole($role)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Role already assigned to this user'
                ], 422);
            }

            $user->assignRole($role);

            return response()->json([
                'status' => 'success',
                'message' => 'Role assigned successfully'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to assign role'
            ], 500);
        }
    }

    public function revokeRole(Request $request): JsonResponse
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);
        try {

            $role = Role::findOrFail($request->role_id);
            $user = User::findOrFail($request->user_id);

            if (!$user->hasRole($role)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Role not assigned to this user'
                ], 422);
            }

            $user->removeRole($role);

            return response()->json([
                'status' => 'success',
                'message' => 'Role revoked successfully'
            ]);
        } catch (\Throwable $th) {
            // Log the error
            logger()->error($th->getMessage());

            // Return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to revoke role'
            ], 500);
        }
    }
}
