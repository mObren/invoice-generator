@extends('layout')
@section('title', 'Profile of ' . $user->username)

@section('content')



@foreach($user->clients as $client)

{{$client->company_name}}

@foreach ($client->invoices as $invoice)

{{ $invoice->date}}
    
@endforeach

<br>

@endforeach
    
@endsection