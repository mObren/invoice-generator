@extends('layout')

@section('title', "Invoice no. $invoice->id")

@section('content')

<div class="justify-items-center py-2 px-6 ml-28">
    <h2 class="text-2xl text-gray-700 font-bold uppercase">Invoice no. {{$invoice->id}}</h2>
</div>
<div class="absolute top-32 right-12 p-2">
    <div class="inline ">
    @if ($invoice->status === 0)
        
    
        <a 
        class="rounded p-2 text-green-700 mr-1 font-semibold bg-gray-300 text-sm cursor-pointer" 
        href="/invoices/change/{{$invoice->id}}">
        Mark as paid
        </a>
    @else
         <a 
         class="rounded p-2 text-red-700 mr-1 font-semibold bg-gray-300 text-sm cursor-pointer" 
         href="/invoices/change/{{$invoice->id}}">
         Mark as unpaid
        </a>

    @endif
    </div>
    <div class="inline">
        <a class="rounded p-2 text-blue-700 font-semibold bg-gray-300 text-sm cursor-pointer" 
        href="/invoices/export/{{$invoice->id}}">View PDF format</a>
    </div>
    <div class="inline">
        <a class="rounded p-2 text-blue-700 font-semibold bg-gray-300 text-sm cursor-pointer" 
        href="/invoices/pdf/{{$invoice->id}}">Download PDF</a>
    </div>
    
    <div class="inline">
        <a class="rounded p-2 text-blue-700 font-semibold bg-gray-300 text-sm cursor-pointer" href="/invoices/send/{{$invoice->id}}">Send to client</a>
    </div>
    <div class="inline">
        <a class="rounded p-2 text-yellow-700 font-semibold bg-gray-300 text-sm cursor-pointer"  href="/invoices/create/{{$invoice->id}}">Edit</a>
    </div>
   
        <form class="inline" action="/invoices/delete/{{$invoice->id}}" method="POST">
        @csrf
         <input class="rounded p-2 text-red-700 font-semibold bg-gray-300 text-sm cursor-pointer" type="submit" value="Delete">
        
        </form>
  
  
</div>


<div class="absolute justify-center w-9/12 mt-6 py-6 px-6 bg-white rounded shadow-lg right-12">

    <div class="ml-12 divide">
        <table>
            <tbody>
                <tr>
                    <td class="border-4 w-32 px-3 py-6">
                        <p class="text-sm">  Client:</p> 
                        <p class="text-md text-blue-700 font-semibold">
                             <a href="/clients/{{$invoice->client_id}}">{{$invoice->client->company_name}}</a> 
                        </p> 
                    </td>
                    <td class="border-4 px-3 py-6">
                        <p class="text-sm">Tax number:</p>
                        <p class="text-sm font-semibold"> {{$invoice->client->tax_number}} </p> 
                     </td>
                     <td class="border-4 px-3 py-6">
                        <p class="text-sm">Registration number:</p>
                        <p class="text-sm font-semibold"> {{$invoice->client->registration_number}} </p> 
                     </td>
                    <td class="border-4 px-3 py-6">
                        <p class="text-sm">Invoice date:</p>
                        <p class="text-sm font-semibold">{{date('d.m.Y.', strtotime($invoice->date))}}</p>    
                    </td>
                    <td class="border-4 px-3 py-6">
                        <p class="text-sm">Valute:</p>
                        <p class="text-sm font-semibold">{{date('d.m.Y.', strtotime($invoice->valute))}}</p>    
                     </td>
                    <td class="border-4 px-3 py-6 w-32">
                        <p class="text-sm">Status:</p>
                        <p class="text-sm {{$invoice->status === 0 ? 'text-red-700' : 'text-green-600'}}
                             font-semibold">{{$invoice->status === 0 ? 'Not paid' : 'Paid' }}
                        </p>   
                     </td>
                     <td class="w-36 border-4 px-3 py-6">
                        <p class="text-sm">Total to pay:</p>
                        <p class="text-xs {{$invoice->status === 0 ? 'text-red-700' : 'text-green-600'}}
                             font-semibold">{{$invoice->status === 0 ? $invoice->getTotal() : '0'}} rsd
                        </p>   
                     </td>
                </tr>

    
            </tbody>
        </table>
    </div>

   
  
    <div class="my-2 divide py-4">
        <form action="/items/create" method="post">
            @csrf
            <div class="flex rounded shadow-lg py-2">
                <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                <div class="w-96 px-3">
                    <label class="font-bold text-gray-700 text-sm mr-1" for="service">Description :</label>
                    <input 
                    class="py-1 mx-2 px-2 w-60 rounded border border-gray-500 text-xs focus:border-blue-400 outline-none"
                    name="service"
                    id="service"
                    type="text">
                    @error('service')
                    <x-form-error>{{$message}}</x-form-error>
                      
                  @enderror
                    
                </div>
                <div class="w-40">
                    <label class="font-bold text-gray-700 text-sm mr-1" for="quantity">Quantity :</label>
                    <input 
                    class="mx-1 py-1 px-2 w-16 rounded border border-gray-500 text-xs focus:border-blue-400 outline-none"
                    name="quantity"
                    id="quantity" 
                    type="number">
                    @error('quantity')
                    <x-form-error>{{$message}}</x-form-error>
                      
                  @enderror
                </div>
             
                <div class="w-44">
                    <label class="font-bold text-gray-700 text-sm mr-1" for="price">Price :</label>
                    <input 
                    class="mx-1 py-1 px-2 w-24 rounded border border-gray-500 text-xs focus:border-blue-400 outline-none" 
                    name="price"
                    id="price"
                    type="text">
                    @error('price')
                    <x-form-error>{{$message}}</x-form-error>
                      
                  @enderror
                </div>
                <div class="w-36">
                    <label class="font-bold text-gray-700 text-sm mr-1" for="pdv">Tax : </label>
                    <input 
                    class="mx-1 py-1 px-2 w-16 rounded border border-gray-500 text-xs focus:border-blue-400 outline-none" 
                    name="pdv"
                    id="pdv"
                    type="number">
                    @error('pdv')
                    <x-form-error>{{$message}}</x-form-error>
                      
                  @enderror
                </div>
                <div class="w-32">
                    <input 
                    class="rounded-lg cursor-pointer bg-blue-500 hover:bg-blue-400 text-white font-semibold px-1 py-1 text-sm"
                     type="submit" value="+Add item">
                </div>
                
                


            </div>
        </form>
   
    </div>
    <div class=" flex rounded shadow-md">

        <div class="p-2 m-3 w-44">
            <p class="h-8 text-sm font-semibold p-1">Service/Item</p>
            @foreach($invoice->items as $item)
            <p class="h-8 text-xs text-gray-700 font-semibold p-1">{{$item->service}}</p>
            @endforeach
        </div>
        <div class="p-2 m-3 w-44">
            <p class="h-8 text-sm font-semibold p-1">Quantity</p>
            @foreach($invoice->items as $item)
            <p class="h-8 text-xs text-gray-700 font-semibold p-1">{{$item->quantity}}</p>
            @endforeach        
        </div>
        <div class="p-2 m-3 w-44">
            <p class="h-8 text-sm font-semibold p-1">Tax</p>
            @foreach($invoice->items as $item)
            <p class="h-8 text-xs text-gray-700 font-semibold p-1">{{$item->pdv}}%</p>
            @endforeach       
        </div>
        <div class="p-2 m-3 w-44">
            <p class="h-8 text-sm font-semibold p-1">Price</p>
            @foreach($invoice->items as $item)
            <p class="h-8 text-xs text-gray-700 font-semibold p-1">{{number_format($item->price, 2, ',','.')}}</p>
            @endforeach       
        </div>
        <div class="p-2 m-3 w-36">
            <p class="h-8 text-sm font-semibold p-1">Delete item</p>
            @foreach($invoice->items as $item)
            
           <p>
            
            <form class="inline" action="/items/delete/{{$item->id}}" method="POST">
            @csrf
             <input class="h-8 bg-white cursor-pointer text-xs text-red-700 font-semibold p-1"  type="submit" value="Remove">
            
            </form>
         
            </p> 

      
            @endforeach       

        </div>
        
    </div>
    <div class="flex">
            <div class="p-2 mx-3 w-44">
                <p class="h-8 text-md font-semibold p-1">Total:</p>
            </div>  
            <div class="p-2 mx-3 w-44">
            </div>
            <div class="p-2 mx-3 w-44">
            </div>
            <div class="p-2 mx-3 w-44">
                <p class="h-8 text-md font-semibold p-1">{{$invoice->getTotal()}} rsd</p>
            </div>
    </div>
</div>

@endsection