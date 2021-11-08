@extends('layout')
@section('title', "Create invoice")
@section('content')
    
<div class="flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow 2x1 w-1/2">
        <h2 class="text-2xl font-bold mb-8 text-gray-700">{{isset($invoice) ? 'Edit' : 'Create' }} invoice</h2>
        <form class="space-y-3" action="/invoices/save/{{$invoice->id ?? ''}}" method="POST">
            @csrf
          <!-- Client -->
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="client_id">Client</label>
                <select class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                    name="client_id" id="client_id">
                    <option value="">-Select client-</option>
                 @foreach(auth()->user()->clients as $client) {
                      <option @if(isset($invoice) && $invoice->client->id === $client->id) {{'selected'}}  @endif value="{{$client->id}}">
                        {{$client->company_name}}
                      </option>
                 }
                 @endforeach
                </select>
            </div>
            @error('client_id')
              <x-form-error>{{$message}}</x-form-error>
                
            @enderror
          <!-- Date -->
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="date">Date</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="date"
                 value="{{ date('m/d/Y', strtotime($invoice->date ?? '')) ?? '' }} "name="date" id="date">
            </div>
            <div>
                
            </div>
            @error('date')
           <x-form-error>{{$message}}</x-form-error>
                
            @enderror
          <!-- Valute -->
            <div class="mb-4">
                <label class="font-bold text-gray-700 text-sm mr-2" for="valute">Valute</label>
                <input class="py-1 px-2 w-full rounded border border-gray-500 focus:border-blue-400 outline-none"
                 type="date" value="{{$invoice ?? ''->valute ?? ''}} "name="valute" id="valute">
            </div>
            @error('valute')
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