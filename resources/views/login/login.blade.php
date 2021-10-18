@extends('layout')


@section('title', 'Login')


@section('content')


<form class="register_form" action="/login" method="POST">
    @csrf
    <h2>Login</h2>
    <br>

    <label for="username">Username</label>
    <input
    class="textfield"
    type="text"
    id="username"
    name="username"
    value=" {{old('username')}}">   
    @error('username')

    <p class="error_message"> {{$message}}</p>
        
    @enderror
    <label for="email">Email</label>
    <input 
    class="textfield" 
    type="email" 
    id="email" 
    name="email"
    value=" {{old('email')}}">
    @error('email')

    <p class="error_message"> {{$message}}</p>
        
    @enderror

    <label for="password">Password</label>
    <input
    class="textfield" 
    type="password" 
    id="password" 
    name="password"
    >
    @error('is_active')

    <p class="error_message"> {{$message}}</p>
        
    @enderror
  

    <input class="button" type="submit" value="Login">

</form>
    
@endsection