<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $user = User::where('email',$request->email)->first();

        if ($user !== null) {

        if ($user->is_active === 1) {
     
            return $next($request);
       } else {

           return response()->json('Access forbiden. This account has been banned.');
       }

        } else {
            return $next($request);
        }

            
    }
        
}
