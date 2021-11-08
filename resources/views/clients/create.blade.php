@extends('layout')
@section('title', 'Add/edit client')
@section('content')
<div class="flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow 2x1 w-1/2">
        <h2 class="text-2xl font-bold mb-8 text-gray-700">{{isset($client) ? 'Edit' : 'Create' }} client</h2>
        <form class="space-y-3" action="/clients/save/{{$client->id ?? ''}}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="company_name">Company name</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{$client->company_name ?? ''}} "name="company_name" id="company_name">
            </div>
            @error('company_name')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="email">Email</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{$client->email ?? ''}} "name="email" id="email">
            </div>
            @error('email')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="city">City</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{$client->city ?? ''}} "name="city" id="city">
            </div>
            @error('city')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="country">Country</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{$client->country ?? ''}} "name="country" id="country">
            </div>
            @error('country')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="address">Address</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{$client->address ?? ''}} "name="address" id="address">
            </div>
            @error('address')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="zip_code">Zip code</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{$client->zip_code ?? ''}} "name="zip_code" id="zip_code">
            </div>
            @error('zip_code')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="tax_number">Tax number</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{$client->tax_number ?? ''}} "name="tax_number" id="tax_number">
            </div>
            @error('tax_number')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="registration_number">Registration number</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="text" value="{{$client->registration_number ?? ''}} "name="registration_number" id="registration_number">
            </div>
            @error('registration_number')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
            <input class="w-full float-right block p-2 bg-blue-500 
            hover:bg-blue-400 rounded text-gray-200 cursor-pointer font-bold text-lg"
             type="submit" value="Confirm">
            
        
        </form>
        <button  class="w-full"  >   <a   class="w-full mt-3 float-right block p-2 bg-red-500 
        hover:bg-red-400 rounded text-gray-200 cursor-pointer font-bold text-lg"  href="{{ url()->previous() }}">Cancel</a></button>
    </div>
</div>
    
@endsection