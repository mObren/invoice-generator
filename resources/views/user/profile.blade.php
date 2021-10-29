@extends('layout')
@section('title', 'Profile of ' . $user->username)
@section('content')
<div class="bg-white shadow-lg">
    <div class="justify-items-center py-3 px-6 mb-8 ml-28">
    <p class="text-3xl text-gray-700 font-bold">INFORMATIONS ABOUT USER </p>
        
    </div>
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Username: {{$user->username }}</p>
    </div>
    
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Company name: {{$user->company_name }}</p>
    </div>
    
    
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Email: {{$user->email }}</p>
    </div>
  
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Date: {{date('d-m-Y h:i:s', time()) }}</p>
    </div>
    
    
  
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">City: {{$user->city }}</p>
    </div>
    
    
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Number of clients: {{$user->clients->count() }}</p>
    </div>
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Number of invoices: {{$user->invoices->count() }}</p>
    </div>
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Tax number: {{$user->tax_number }}</p>
    </div>
    
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Phone number: {{$user->phone_number }}</p>
    </div>
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-sm text-gray-800 font-semibold">Account number: {{$user->current_account }}</p>
    </div>
    
</div>
<div class="bg-white mt-10 shadow-lg">
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-md text-gray-800 font-semibold">Change informations about user</p>
        <p><a class="h-8 bg-white text-blue-700 cursor-pointer text-xs hover:text-blue-500  font-semibold p-1 " href="/user/edit/{{$user->id}}">Edit your account</a></p>
    </div>
</div>
<div class="bg-white mt-10 shadow-lg">
    <div class="justify-items-center py-3 px-6 ml-16">
        <p class="text-md text-gray-800 font-semibold">Dangerous zone!</p>
    </div>
    <form class="ml-16 px-5 py-3" action="/user/delete/{{$user->id}}" method="POST">
        @csrf
         <input class="h-8 text-red-700  bg-white cursor-pointer text-xs hover:text-red-500 font-semibold p-1"  type="submit" value="Delete your account">
        
        </form>
</div>
    
<br>
    
@endsection