@extends('layout')

@section('title', "All invoices")

@section('content')
<div class="justify-items-center py-2 px-6 mb-6 ml-28">
    <h2 class="text-2xl text-gray-700 font-bold uppercase">List of All Invoices</h2>
</div>
<div class="float-right mt-2">
    <form action="/invoices" method="get">
        <div class="flex">

        <div class="ml-2">
            <label class="text-xs text-gray-800 ml-1 mr-1" for="search_date_from">Date from</label>
                <input 
                class="text-xs h-6 bg-gray-300 px-2 py-1 w-32 outline-none text-gray-800 rounded-lg"
                name="search_date_from"
                id="search_date_from"
                value="{{request('search_date_from')}}"
                type="date">
        </div> 
        <div class="ml-2">
            <label class="text-xs text-gray-800 ml-1 mr-1"  for="search_date_to">To</label>

                <input 
                class="text-xs h-6 bg-gray-300 px-2 py-1 w-32 outline-none text-gray-800 rounded-lg" 
                name="search_date_to"
                value="{{request('search_date_to')}}"

                id="search_date_to"
                type="date">
        </div>

        <div class="ml-2">
            <label class="text-xs text-gray-800 ml-1 mr-1" for="search_valute_from">Valute from</label>
                <input 
                class="text-xs h-6 bg-gray-300 px-2 py-1 w-32 outline-none text-gray-800 rounded-lg"
                name="search_valute_from"
                id="search_valute_from"
                value="{{request('search_valute_from')}}"
                type="date">
        </div> 
        <div class="ml-2">
            <label class="text-xs text-gray-800 ml-1 mr-1"  for="search_valute_to">To</label>

                <input 
                class="text-xs h-6 bg-gray-300 px-2 py-1 w-32 outline-none text-gray-800 rounded-lg" 
                name="search_valute_to"
                id="search_valute_to"
                value="{{request('search_valute_to')}}"
                type="date">
        </div>
        <div class="ml-2">
            <select
            class="text-xs h-6 bg-gray-300 px-2 py-1 w-22 outline-none font-semibold text-gray-800 rounded-lg" 
            name="search_status"
            id="search_status"

            >
            <option {{request('search_status') === "" ? 'selected' : ''}} value="">-Status-</option>
            <option {{request('search_status') == "0" ? 'selected' : ''}} value="0">Not paid</option>
            <option {{request('search_status') == "1" ? 'selected' : ''}} value="1">Paid</option>


            </select>
    </div>
        
    
        <div class="ml-2">
            <input 
            class="text-xs bg-gray-300 px-2 py-1 w-36 outline-none font-semibold text-gray-800 rounded-lg" 
            placeholder="Company name..." 
            name="search_company"
            id="search_company"
            value="{{request('search_company')}}"
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

<div class="bg-white flex rounded shadow-md mt-24">
    <div class="p-2 m-3 w-28">
        <p class=" h-8 text-sm font-semibold p-1">Invoice no.</p>
        @foreach($invoices as $invoice)
        <p class="h-8 text-xs text-gray-700 font-semibold p-1">{{$invoice->id}}</p>
        @endforeach
    </div>

    <div class="p-2 m-3 w-44">
        <p class="h-8 text-sm font-semibold p-1">Client</p>
        @foreach($invoices as $invoice)
        <p class="h-8 text-xs text-blue-900 hover:text-blue-800 font-semibold p-1">
            <a href="/clients/{{$invoice->client_id}}">{{$invoice->client->company_name}}</a>
        </p>
        @endforeach
    </div>
    <div class="p-2 m-3 w-28">
        <p class="h-8 text-sm font-semibold p-1">Invoice date</p>
        @foreach($invoices as $invoice)
        <p class="h-8 text-xs text-gray-700 font-semibold p-1">{{date('d.m.Y.', strtotime($invoice->date))}}</p>
        @endforeach        
    </div>
    <div class="p-2 m-3 w-28">
        <p class="h-8 text-sm font-semibold p-1">Valute</p>
        @foreach($invoices as $invoice)
        <p class="h-8 text-xs text-gray-700 font-semibold p-1">
            {{$invoice->valute < date('Y-m-d', time()) ? '* ' . date('d.m.Y.', strtotime($invoice->valute)) :
            date('d.m.Y.', strtotime($invoice->valute))}}
            </p>
        @endforeach       
    </div>
    <div class="p-2 m-3 w-24">
        <p class="h-8 text-sm font-semibold p-1">Status</p>
        @foreach($invoices as $invoice)
        <p class="h-8 text-xs {{$invoice->status === 0 ? 'text-red-700' : 'text-green-600'}} font-semibold p-1">
            {{$invoice->status === 0 ? 'Not paid' : 'Paid'}}
        </p>
        @endforeach
    </div>
    <div class="p-2 m-3 w-40">
        <p class="h-8 text-sm font-semibold p-1">Total</p>
        @foreach($invoices as $invoice)
        <p class="h-8 text-xs text-gray-700 font-semibold p-1">{{$invoice->getTotal()}} rsd</p>
        @endforeach       
    </div>
    <div class="p-2 m-3 w-28">
        <p class="h-8 text-sm font-semibold p-1">Options</p>
        @foreach($invoices as $invoice)
        
        <x-small-dropdown>

            <a href="/invoices/{{$invoice->id}}" 
                class="block px-4 py-2 text-xs  text-gray-700 hover:bg-blue-500 hover:text-white">
              View
            </a>
            <a href="/invoices/create/{{$invoice->id}}" 
                class="block px-4 py-2 text-xs  text-gray-700 hover:bg-blue-500 hover:text-white">
              Edit
            </a>
            <form action="/invoices/delete/{{$invoice->id}}" method="post">
            @csrf
            <p> 
            <input class="block px-4 py-2 text-xs text-gray-700 bg-gray-100 cursor-pointer pr-16 hover:bg-blue-500 hover:text-white" value ="Delete" type="submit">

            </p>
            </form>
            <a href="/invoices/toggle/{{$invoice->id}}" 
                class="block px-4 py-2 text-xs text-gray-700 hover:bg-blue-500 hover:text-white">
            Change status
            </a>
            
        </x-small-dropdown>
        @endforeach       
    </div>
</div>

@if(count($invoices) == 0)
    <p class="p-2 m-2 text-lg font-semibold">  
           No results.
    </p>
@else
<div class=" mt-4">
    <p class="text-xs font-semibold text-gray-700"> * - Stared invoices are out of valute.</p>
</div>
{{-- @dd(request('search_status')) --}}
   

{{$invoices->links()}}

@endif

<div class=" float-right my-3">
   <x-button-add><a href="/invoices/create">+Create new</a></x-button-add>
</div>

@endsection