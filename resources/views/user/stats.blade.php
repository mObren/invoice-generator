@extends('layout')

@section('title', 'Stats')


@section('content')



<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="justify-items-center py-2 px-6 mb-10">
        <h2 class="text-2xl text-gray-700 font-bold uppercase">Stats</h2>
    </div>
    
    <form action="/stats" method="get">
        <div class="">
        <div>
            <label class="text-lg font-semibold text-gray-800 ml-1 mr-5" for="paid_from">Display total income for period from : </label>
            <input 
            class="text-sm h-6 bg-gray-300 px-2 py-1 w-44 outline-none text-gray-800 rounded-lg"
            type="date" 
            name="paid_from" 
            value="{{request('paid_from')}}"
            id="paid_from">
            <label class="text-lg font-semibold text-gray-800 ml-1 mr-6" for="paid_to">to : </label>
            <input 
            class="text-sm h-6 bg-gray-300 px-2 py-1 w-44 outline-none text-gray-800 rounded-lg" 
            type="date" 
            name="paid_to"
            value="{{request('paid_to')}}"
            id="paid_to">
        </div>

        @if(null!==(request('paid_from')) || null!==(request('paid_to')))
        <p class="p-1 mt-2 font-semibold text-green-700">
            {{"Total income for given period " . $income . " rsd" ?? 'No results for given period.'}}
        </p>
        @endif

        <div class="mt-10">
            <label class="text-lg font-semibold text-gray-800 ml-1 mr-14" for="search_date_from">Display all dues for period from : </label>
            <input 
            class="text-sm h-6 bg-gray-300 px-2 py-1 w-44 outline-none text-gray-800 rounded-lg" 
            type="date" 
            name="search_date_from"
            value="{{request('search_date_from')}}"
            id="search_date_from">
            <label class="text-lg font-semibold text-gray-800 ml-1 mr-6" for="search_date_to">to : </label>
            <input 
            class="text-sm h-6 bg-gray-300 px-2 py-1 w-44 outline-none text-gray-800 rounded-lg"  
            type="date" 
            name="search_date_to"
            value="{{request('search_date_to')}}"
            id="search_date_to">
        </div>
        @if(null!==(request('search_date_from')) || null!==(request('search_date_to')))
        <p class="p-1 mt-2 font-semibold text-red-700">
            {{"Total of dues for given period " . $dues . " rsd" ?? 'No results for given period.'}}
        </p>
        @endif


    </div>

    <div class="mt-10">
        <input class="text-white px-2 py-1 font-semibold rounded-md bg-gray-700 hover:bg-gray-600 cursor-pointer" type="submit" value="Submit search">
    </div>

    <div class="mt-10 text-lg font-semibold text-gray-800">
     <p> Number of clients : {{ auth()->user()->clients->count()}}</p> 
     <p> Number of paid invoices : {{ auth()->user()->invoices->where('status', 1)->count()}}</p> 
     <p> Number of unpaid invoices : {{ auth()->user()->invoices->where('status', 0)->count()}}</p> 


    </div>

    </form>
    

</div>
@endsection