@extends('layout')
@section('title', $client->company_name . ' Invoices')
@section('content')
<div class="justify-items-center py-3 px-6 ml-28">
    <h2 class="text-2xl text-gray-700 font-bold uppercase">{{$client->company_name . "'s Invoices"}}</h2>
</div>
<div class="flex">
    <table class="w-full bg-white whitespace-nowrap border-gray-500 border-4">
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
                <td class="border-2 px-6 py-2">{{$invoice->getTotal($invoice->client_id)}} rsd</td>
                <td class="border-2 px-6 py-2">
                  <x-button-dropdown> 
                <a href="/invoices/{{$invoice->id}}" 
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">
                  View
                </a>
                <a href="/invoices/create/{{$invoice->id}}" 
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">
                  Edit
                </a>
                <a href="/invoices/toggle/{{$invoice->id}}" 
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">
                Change status
                </a>
                <form  action="/invoices/delete/{{$invoice->id}}" method="post">
                    @csrf
                    <p> 
                    <input class="block bg-white cursor-pointer px-4 py-2 text-sm pr-16 text-gray-700 hover:bg-blue-500 hover:text-white" value ="Delete" type="submit">
                    </p>
                </form>
                  </x-button-dropdown>
                </td>
    
    
            </tr>       
           
           
            @endforeach
    
        </tbody>
    </table>  
       
    
    </div>
    {{ $invoices->links()}}
    <div class=" my-5 float-right">
        <x-button-add><a class="text-gray-200 font-bold" href="/invoices/add-to-client/{{$client->id}}">+Add invoice</a></x-button-add>
    
    </div>
    
@endsection