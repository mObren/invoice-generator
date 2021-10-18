@extends('layout')
@section('title', 'All clients')

@section('content')
@if ($clients)
    

<div class="flex">
<table class="w-full whitespace-nowrap border-gray-500 border-4">
    <thead class="">
        <tr class="text-left font-bold">
            <x-table-cell>Company name</x-table-cell>
            <x-table-cell>Street address</x-table-cell>
            <x-table-cell>City</x-table-cell>
            <x-table-cell>Country</x-table-cell>
            <x-table-cell>Zip code</x-table-cell>
            <x-table-cell>Total amount</x-table-cell>
            <x-table-cell>Options</x-table-cell>
        </tr>

    </thead>
    <tbody class="text-sm">
        @foreach($clients as $client)
        <tr>
            <td class="font-bold border-2 px-6 py-2"><a href="/clients/{{$client->id}}">{{$client->company_name}}</a></td>
            <td class="border-2 px-6 py-2">{{$client->address}}</td>
            <td class="border-2 px-6 py-2">{{$client->city}}</td>
            <td class="border-2 px-6 py-2">{{$client->country}}</td>
            <td class="border-2 px-6 py-2">{{$client->zip_code}}</td>
            <td class="border-2 px-6 py-2">${{$client->getTotalToPay()}}</td>
            <td class="border-2 px-6 py-2">
              <x-button-dropdown>   <a href="/clients/{{$client->id}}" 
                class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
              View
            </a>
            <a href="/clients/create/{{$client->id}}" 
                class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
              Edit
            </a>
            <a href="/clients/delete/{{$client->id}}" 
                class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                Delete
            </a>
            <a href="/clients/invoices/{{$client->id}}" 
              class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
              All invoices
          </a>
              </x-button-dropdown>
            </td>


        </tr>       
       @endforeach
       

    </tbody>
</table>    

</div>
@else
<h2>There are not any clients yet.</h2>
@endif

<div class=" my-5 float-right">
    <x-button-add><a class="text-gray-200 font-bold" href="/clients/create">+Add client</a></x-button-add>

</div>




    
@endsection