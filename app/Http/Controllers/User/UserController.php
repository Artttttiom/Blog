<?php

namespace app\Http\Controllers\User;


use App\Models\Users;
use Illuminate\Http\JsonResponse;

class UserController 
{
    public function users(): JsonResponse
    {
        return response()->json(Users::get(), 200);
    }

    public function user($id): JsonResponse
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'data' => $user,
            'status' => 200
        ], 200);
    }
}
