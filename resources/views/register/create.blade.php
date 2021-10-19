@extends('layout')

@section('title', 'Register')
@section('content')


<div class="flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow 2x1 w-1/2">
        <h2 class="text-2xl font-bold mb-8 text-gray-700">Create your account</h2>
        <form class="space-y-3" action="/register" method="POST">
            @csrf
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="username">Username</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{old('username')}}"name="username" id="username">
            </div>
            @error('username')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
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
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="company_name">Company</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="company_name" value="{{old('company_name')}}"name="company_name" id="company_name">
            </div>
            @error('company_name')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="city">City</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{old('city')}}"name="city" id="city">
            </div>
            @error('city')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
   
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="address">Address</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{old('address')}}"name="address" id="address">
            </div>
            @error('address')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="zip_code">Zip code</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{old('zip_code')}}"name="zip_code" id="zip_code">
            </div>
            @error('zip_code')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="tax_number">Tax number</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{old('tax_number')}}"name="tax_number" id="tax_number">
            </div>
            @error('tax_number')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="registration_number">Registration number</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{old('registration_number')}}"name="registration_number" id="registration_number">
            </div>
            @error('registration_number')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="phone_number">Phone number</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{old('phone_number')}}"name="phone_number" id="phone_number">
            </div>
            @error('phone_number')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="current_account">Current account number</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{old('current_account')}}"name="current_account" id="current_account">
            </div>
            @error('current_account')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror

            <input class="w-full float-right block p-2 bg-blue-500 
            hover:bg-blue-400 rounded text-gray-200 cursor-pointer font-bold text-lg"
             type="submit" value="Sign up">
        
        </form>
<p class="text-xs  p-2">Already have an account? <a class="text-blue-500 font-semibold" href="/login">Login</a></p>
        
    </div>
</div>


    
@endsection
    