<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $validated = Validator::make($request->post(), [
            'username' => 'required',
            'password' => 'required',
        ])->validate();
        
        if(!Auth::attempt($validated))
            throw ValidationException::withMessages([
                'username' => [trans('auth.failed')],
            ]);

        $data = [
            'user' => $user = Auth::user(),
            'token' => $user->createToken('APP')->plainTextToken,
        ];

        return $this->sendResponse(200, $data, 'login successfully');
    }

    public function register(Request $request)
    {
        $validated = Validator::make($request->post(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
        ])->validate();
        
        $validated['password'] = bcrypt($validated['password']);
        
        $user = User::create($validated);
        $data = [
            'user' => $user,
            'token' => $user->createToken('APP')->plainTextToken,
        ];

        return $this->sendResponse(200, $data, 'User successfully registered');
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->sendResponse(200, [], 'Logout Successfully');
    }
}
