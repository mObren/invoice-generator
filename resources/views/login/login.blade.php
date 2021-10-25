@extends('layout')


@section('title', 'Login')


@section('content')
<div class="flex items-center justify-center">


<div class="bg-white p-8 rounded-lg shadow 2x1 w-1/3">
    <h2 class="text-2xl font-bold mb-8 text-gray-700">Login</h2>
    <form class="space-y-3" action="/login" method="POST">
        @csrf
   
        <div class="mb-4">
            <label class="font-bold text-gray-700 text-sm mr-2" for="email">Email</label>
            <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
             type="email" value="{{old('email')}}"name="email" id="email">
        </div>
        @error('email')
       <x-form-error>{{$message}}</x-form-error>
            
        @enderror
        <div class="mb-4">
            <label class="font-bold text-gray-700 text-sm mr-2" for="password">Password</label>
            <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
             type="password" value="{{old('password')}}"name="password" id="password">
        </div>
        @error('password')
       <x-form-error>{{$message}}</x-form-error>
            
        @enderror
        <input class="w-full float-right block p-2 bg-blue-500 
        hover:bg-blue-400 rounded text-gray-200 cursor-pointer font-bold text-lg"
         type="submit" value="Login">
    
    </form>
<p class="text-xs  p-2">Don't have an account? <a class="text-blue-500 font-semibold" href="/register">Register</a></p>
    
</div>
</div>

    
@endsection