@extends('layout')
@section('title', 'Profile of ' . $user->username)

@section('content')

<div class="bg-white">
    <div class="justify-items-center py-3 px-6 ml-28">
    <p class="text-3xl text-gray-700 font-bold">INFORMATIONS ABOUT USER </p>
        
    </div>

    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Username: {{$user->username }}</p>
    </div>
    
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Company name: {{$user->company_name }}</p>
    </div>
    
    
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Email: {{$user->email }}</p>
    </div>
  
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Date: {{date('d-m-Y h:i:s', time()) }}</p>
    </div>
    
    
  
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">City: {{$user->city }}</p>
    </div>
    
    
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Number of clients: {{$user->clients->count() }}</p>
    </div>
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Number of invoices: {{$user->invoices->count() }}</p>
    </div>
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Tax number: {{$user->tax_number }}</p>
    </div>
    
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Phone number: {{$user->phone_number }}</p>
    </div>
    <div class="justify-items-center py-3 px-6 ml-28">
        <p class="text-2xl text-gray-700 font-bold">Account number: {{$user->current_account }}</p>
    </div>
    
</div>



    

<br>

    
@endsection