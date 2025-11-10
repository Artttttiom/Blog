<?php

namespace App\Http\Controllers\User;

use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class UserController 
{
    public function users(): JsonResponse
    {
        return response()->json(Users::get(), 200);
    }
 public function show(Request $request) {
        $perPage = $request->input('per_page', 15);
        return response()->json(Users::query()->simplePaginate($perPage), 200);
    }

    public function index($id): JsonResponse
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

    public function store( Request $request) {
        $user = Users::create($request->all());

        return response()->json( [
            'success' => true,
            'data' => $user,
            'message' => 'User created successfully'
        ], 201);
    }

    public function update(Request $request, $id) {
        $user = Users::query()->find($id);
        $user->update($request->only(['name', 'patronymic']));
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User updated successfully'
        ], 200);
}
    public function destroy($id) {
        $user = Users::query()->find($id);
        $user->delete();


        return response()->json([
            'success' => true,
            'message' => 'User deleted successfuly',
        ], 200);
        
    }



}