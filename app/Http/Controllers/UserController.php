<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users, 200);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to get data');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'name' => 'required|string',
                'password' => 'required|string|min:6|max:8',
            ]);

            $user = User::create($request->all());

            return response()->json($user, 201);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to add data');
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json($user, 200);
        } catch (Exception $e) {
            return $this->handleException($e, 'Data not found');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $request->validate([
                'email' => 'sometimes|required|email|unique:users,email,' . $id,
                'name' => 'sometimes|required|string',
                'password' => 'sometimes|required|string|min:6|max:8',
            ]);


            $user->update($request->all());

            return response()->json($user, 200);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to update data');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->delete();

            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to delete data');
        }
    }
}
