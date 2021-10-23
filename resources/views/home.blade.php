@extends('layout')

@section('title', 'Home')


@section('content')
<div class="justify-center">

    <div class="flex justify-center font-bold text-gray-700 text-4xl">
     
      
     
     <div class="grid justify-items-center bg-white p-8 mt-10 rounded-lg shadow 2x1 w-4/5">
        <p class="uppercase">
            Welcome to Invoice generator app!
         </p>
         @guest
         
     <p class="text-sm mt-10 p-2">Go and make some invoices! <a class="text-blue-500  font-semibold" href="/login">Login</a></p>
     
     <p class="text-sm  p-2">Don't have an account yet? <a class="text-blue-500 font-semibold" href="/register">Sign up now</a></p>
     @endguest

         
     </div>
     
             
         
     </div>
</div>

@endsection