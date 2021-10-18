<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function destroy() {

        //Log the user out
        Auth::logout();

        return redirect('/')->with('success', 'You are logged out.');
    }

    public function create() {
        return view('login.login');

    }


    public function login() {

        $data = request()->validate([
            "username" => 'required',
            "email" => 'required|email',
            "password" => 'required',
        ]);
        if (Auth::attempt($data)) {
                return redirect('/')->with('success', 'Welcome back!');
            // }
            }
            throw ValidationException::withMessages([
                'email' => "Incorrect credentials are provided.",
            ]);
    }
}
