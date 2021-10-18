@extends('layout')

@section('title', 'Register')
@section('content')



    <form class="register_form" action="/register" method="POST">
        @csrf
        <h2>Register</h2>
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
        @error('password')

        <p class="error_message"> {{$message}}</p>
            
        @enderror

        <label for="company_name">Company</label>
        <input 
        class="textfield" 
        type="text" 
        id="company_name" 
        name="company_name"
        value=" {{old('company_name')}}"
        >
        @error('company_name')

        <p class="error_message"> {{$message}}</p>
            
        @enderror

        <label for="address">Address</label>
        <input 
        class="textfield" 
        type="text" 
        id="address" 
        name="address"
        value=" {{old('address')}}">
        @error('address')

        <p class="error_message"> {{$message}}</p>
            
        @enderror

        <label for="city">City</label>
        <input 
        class="textfield" 
        type="text" 
        id="city" 
        name="city"
        value=" {{old('city')}}">
        @error('city')

        <p class="error_message"> {{$message}}</p>
            
        @enderror

        <label for="zip_code">Zip code</label>
        <input 
        class="textfield" 
        type="text" 
        id="zip_code" 
        name="zip_code"
        value=" {{old('zip_code')}}">
        @error('zip_code')

        <p class="error_message"> {{$message}}</p>
            
        @enderror

        <label for="phone_number">Phone number</label>
        <input 
        class="textfield" 
        type="text" 
        id="phone_number" 
        name="phone_number"
        value=" {{old('phone_number')}}">
        @error('phone_number')

        <p class="error_message"> {{$message}}</p>
            
        @enderror

        <label for="tax_number">Tax number</label>
        <input 
        class="textfield" 
        type="text" 
        id="tax_number" 
        name="tax_number"
        value=" {{old('tax_number')}}">
        @error('tax_number')

        <p class="error_message"> {{$message}}</p>
            
        @enderror

        <label for="current_account">Current account</label>
        <input 
        class="textfield" 
        type="text" 
        id="current_account" 
        name="current_account"
        value=" {{old('current_account')}}">
        @error('current_account')

        <p class="error_message"> {{$message}}</p>
            
        @enderror
      




        <input class="button" type="submit" value="Register">

    </form>

    
@endsection
    