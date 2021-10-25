@extends('layout')

@section('title', $client->company_name)


@section('content')

<div class="justify-items-center py-2 px-6 ml-28">
    <h2 class="text-2xl text-gray-700 font-bold uppercase">Informations about client</h2>
</div>
<div class="justify-items-center bg-white py-6 px-6 ml-28">
    <table class="w-full whitespace-nowrap">
        <tbody class="text-gray-700">
            <tr>
                <td class="border px-6 py-2 font-bold">Company name:</td>
                <td class="border px-6 py-2">{{$client->company_name}}</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">Company email:</td>
                <td class="border px-6 py-2">{{$client->email}}</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">City:</td>
                <td class="border px-6 py-2">{{$client->city}}</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">Country:</td>
                <td class="border px-6 py-2">{{$client->country}}</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">Address:</td>
                <td class="border px-6 py-2">{{$client->address}}</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">Zip code:</td>
                <td class="border px-6 py-2">{{$client->zip_code}}</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">Tax number:</td>
                <td class="border px-6 py-2">{{$client->tax_number}}</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">Registration number:</td>
                <td class="border px-6 py-2">{{$client->registration_number}}</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">Total:</td>
                <td class="border px-6 py-2">{{$client->getTotalToPay()}} rsd</td>

            </tr>
            <tr>
                <td class="border px-6 py-2 font-bold">All invoices:</td>
                <td class="border px-6 py-2"><a class="font-semibold text-blue-600" href="/clients/invoices/{{$client->id}}">Display all invoices</a></td>

            </tr>
        </tbody>
    </table>
</div>
<div class="flex float-right">


        <x-button-add><a class="text-gray-200 font-bold" href="/invoices/create">+Add invoice</a></x-button-add>
    

        <a class="bg-yellow-500 rounded-lg ml-3 text-gray-200 font-bold px-4 py-2 hover:bg-yellow-400"
    href="/clients/create/{{$client->id}}"> Edit</a>

    <form  action="/clients/delete/{{$client->id}}" method="post">
        @csrf
        <p> 
        <input class="bg-red-500 cursor-pointer rounded-lg ml-3 mr-4 text-gray-200 font-bold px-4 py-2 hover:bg-red-400" value ="Delete" type="submit">
        </p>
      </form>

    




</div>
    
@endsection
