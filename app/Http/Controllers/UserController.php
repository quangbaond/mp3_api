<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'user_name' => 'required|max:255|unique:users,user_name',
            'password' => 'nullable|min:6|max:255',
        ]);
        $user = auth()->user();
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return $this->sendResponse($user, 'Update user success');
    }
}
