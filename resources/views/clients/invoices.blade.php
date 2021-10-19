@extends('layout')

@section('title', $client->company_name . ' Invoices')

@section('content')
<div class="justify-items-center py-3 px-6 ml-28">
    <h2 class="text-2xl text-gray-700 font-bold uppercase">{{$client->company_name . "'s Invoices"}}</h2>
</div>


<div class="flex">
    <table class="w-full whitespace-nowrap border-gray-500 border-4">
        <thead class="">
            <tr class="text-left font-bold">
                <x-table-cell>Invoice created</x-table-cell>
                <x-table-cell>Valute</x-table-cell>
                <x-table-cell>Status</x-table-cell>
                <x-table-cell>Total</x-table-cell>

                <x-table-cell>Options</x-table-cell>
            </tr>
    
        </thead>
        <tbody class="text-sm">
            @foreach ($invoices as $invoice)
                
            <tr>
                <td class="border-2 px-6 py-2">{{date('d/m/Y', strtotime($invoice->date))}}</td>
                <td class="border-2 px-6 py-2">{{date('d/m/Y', strtotime($invoice->valute))}}</td>
                <td class="border-2 font-semibold {{$invoice->status === 0 ? 'text-red-700' : 'text-green-600'}} px-6 py-2">@if($invoice->status === 0) {{'Not paid'}}  @else {{'Paid'}} @endif </td>
                <td class="border-2 px-6 py-2">{{$invoice->getTotal($client->id)}} rsd</td>

                <td class="border-2 px-6 py-2">
                  <x-button-dropdown> 
                <a href="/invoices/{{$invoice->id}}" 
                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                  View
                </a>
                <a href="/invoices/create/{{$invoice->id}}" 
                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                  Edit
                </a>
                <a href="/invoices/delete/{{$client->id}}" 
                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                Delete
                </a>
                  </x-button-dropdown>
                </td>
    
    
            </tr>       
           
           
            @endforeach
    
        </tbody>
    </table>  
       
    
    </div>
    <div class=" my-5 float-right">
        <x-button-add><a class="text-gray-200 font-bold" href="/invoices/create">+Add invoice</a></x-button-add>
    
    </div>
    
@endsection