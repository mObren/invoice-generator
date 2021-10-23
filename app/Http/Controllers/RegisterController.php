<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    
    public function create() {
        return view('register.create');
    }

    //Validate the form inputs

    public function store(UserRegisterRequest $request) {
        $validated = $request->validated();

        //Store data into database

        $user = User::create($validated);

        //Log the user in after registration

        Auth::login($user);

        //Redirect to home page with succes message

        return redirect("/")->with('success', "Your account has been successfully created!");


    }
}
