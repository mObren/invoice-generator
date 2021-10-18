<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    
    public function create() {
        return view('register.create');
    }

    //Validate the form inputs

    public function store() {
        $data = request()->validate([
            'username' => 'required|unique:users,username|min:4|max:255',
            'password' => 'required|max:255|min:6',
            'email' => 'required|email|unique:users,email|max:255',
            'company_name' => 'required|max:255',
            'address' => 'required',
            'city' => 'required|max:255',
            'zip_code' => 'required',
            'phone_number' => 'required',
            'tax_number' => 'required',
            'current_account' => 'required',
        ]);

        //Store data into database

        $user = User::create($data);

        //Log the user in after registration

        Auth::login($user);

        //Redirect to home page with succes message

        return redirect("/")->with('success', "Your account has been successfully created!");


    }
}
