@extends('layout')
@section('title', 'All clients')

@section('content')
@if ($clients)
    
<div class="justify-items-center py-3 px-6 ml-28">
  <h2 class="text-2xl text-gray-700 font-bold uppercase">List of all clients</h2>
</div>
<div class="float-right mt-2 mr-5">
  <form action="/clients" method="get">
      <div class="flex">

  
      <div class="ml-2">
          <input 
          class="text-xs bg-gray-300 px-2 py-1 w-44 outline-none font-semibold text-gray-800 rounded-lg" 
          placeholder="Company name..." 
          name="search_company"
          value="{{request('search_company')}}"
          id="search_company"
          type="text">
      </div>
      <div class="ml-2">
          <input 
          class="text-xs text-gray-800 font-semibold rounded-lg px-2 py-1 bg-gray-300 cursor-pointer hover:bg-gray-400" 
          type="submit" 
          value="Search">
      </div>

  </div>

  
  </form>
  
</div>


<div class="flex mb-5">
<table class="w-full whitespace-nowrap bg-white border-gray-500 ml-2 mt-16 border-4">
    <thead class="">
        <tr class="text-left font-bold">
            <x-table-cell>Company name</x-table-cell>
            <x-table-cell>Street address</x-table-cell>
            <x-table-cell>City</x-table-cell>
            <td class="border-2 px-2 uppercase text-gray-700 py-4">Country</td>           
            <td class="border-2 px-2 uppercase text-gray-700 py-4">Zip code</td>           
             <x-table-cell>Total to pay</x-table-cell>
            <x-table-cell>Options</x-table-cell>
        </tr>

    </thead>
    <tbody class="text-sm">
        @foreach($clients as $client)
        <tr>
            <td class="font-bold border-2 px-4 py-2"><a href="/clients/{{$client->id}}">{{$client->company_name}}</a></td>
            <td class="border-2 text-xs px-4 py-2">{{$client->address}}</td>
            <td class="border-2 text-xs px-4 py-2">{{$client->city}}</td>
            <td class="border-2 text-xs px-4 py-2">{{$client->country}}</td>
            <td class="border-2 text-xs px-2 py-2">{{$client->zip_code}}</td>
            <td class="border-2 text-xs text-xs px-4 py-2">{{$client->getTotalToPay()}} rsd</td>
            <td class="border-2 text-xs px-4 py-2">
              <x-button-dropdown>   <a href="/clients/{{$client->id}}" 
                class="block px-4 py-2 text-sm  text-gray-700 hover:bg-blue-500 hover:text-white">
              View
            </a>
            <a href="/clients/create/{{$client->id}}" 
                class="block px-4 py-2 text-sm  text-gray-700 hover:bg-blue-500 hover:text-white">
              Edit
            </a>
            <form  action="/clients/delete/{{$client->id}}" method="post">
              @csrf
              <p> 
              <input class="block bg-white cursor-pointer px-4 py-2 text-sm pr-16 text-gray-700 hover:bg-blue-500 hover:text-white" value ="Delete" type="submit">
              </p>
            </form>
            <a href="/clients/invoices/{{$client->id}}" 
              class="block px-4 py-2 text-sm  text-gray-700 hover:bg-blue-500 hover:text-white">
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

{{ $clients->links()}}

<div class=" my-5 float-right">
    <x-button-add><a class="text-gray-200 font-bold" href="/clients/create">+Add client</a></x-button-add>

</div>




    
@endsection