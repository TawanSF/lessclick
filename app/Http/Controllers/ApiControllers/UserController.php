<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;


class UserController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        if ($user) {
            return response()->json([
                'message' => 'User registered successfully'
            ], 201);
        }
        return response()->json([
            'message' => 'User could not registered'
        ], 400);
    }

    public function getAll() {
        $users = User::all();
        if(isset($users)) {
            return response()->json($users);
        }
        return response()->json([
            'message' => 'Users not found'
        ], 400);
    }

    public function getUnique($id) {
        $user = User::find($id);
        if(isset($user)) {
            return response()->json($user);
        }
        return response()->json([
            'message' => 'User not found'
        ], 400);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        if(isset($user)) {
            $request->validate([
                'name' => 'required|string',
                'email' => 'string|email|unique:users'
            ]);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return response()->json($user, 200);
        }
        return response()->json([
            'message' => 'User not found'
        ], 400);
    }

    public function delete($id) {
        $user = User::find($id);
        if(isset($user)) {
            $user->delete();
            return response()->json([
                'message'=> 'User deleted'
            ]);
        }
        return response()->json([
            'message' => 'User not found'
        ], 400);
    }
}
