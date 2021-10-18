<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function profile() {

    $user = User::getCurrentUser();
    $profile = User::with(['clients'])->where('id', $user->id)->get();

    return view('user.profile', [
        'user' => $profile[0]
    ]);
      
    }
}
