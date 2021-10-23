<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function destroy() {

        //Log the user out
        Auth::logout();

        return redirect('/login')->with('success', 'Goodbye.');
    }

    public function create() {
        return view('login.login');

    }


    public function login(UserLoginRequest $request) {

        $validated = $request->validated();
        if (Auth::attempt($validated)) {
                return redirect('/profile')->with('success', 'Welcome back, ' . auth()->user()->username . '!');
            // }
            }
            throw ValidationException::withMessages([
                'email' => "Incorrect credentials are provided.",
            ]);
    }
}
