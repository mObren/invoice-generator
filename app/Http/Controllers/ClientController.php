<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    //Show all clients
    public function index() {
        $clients = Client::fetchAllClients();     
        return view('clients.all', ['clients' => $clients] );
    }


    //Show client profile
    public function single(Client $client) {

        if (Auth::user()->id === $client->user_id) {
            return view('clients.single', [
                'client' => $client
            ]);
        }
        else 
        {
            return redirect('/stats');
        }

    
    }

    //Display form for editing/creating client
    public function create(Client $client = null) {
        if($client !== null) {
            // $client = Client::find($id);
            if (Auth::user()->id === $client->user_id) {
                return view('clients.create', [
                    'client' => $client
                ]);
            } else {
                return redirect('/stats');
            }

        } else {
            return view('clients.create');
        }
    }
    //Store new or updated client to database
    public function store(Client $client = null, ClientStoreRequest $request) {

       

        if ($client !== null) {
            $validated = $request->validated();

            if (Auth::user()->id === $client->user_id) {
                $client->update($validated);
                return redirect("/clients/$client->id")->with('success', 'Client profile has been updated!');
            } else {
                return redirect('/stats');
            }
     

        } else { 

        $userId = auth()->user()->id;
        $validated = $request->validated();

        $validated['user_id'] = $userId;

        Client::create($validated);
        return redirect("/clients")->with('success', "New client has been successfully created!");
        }
    }

    public function delete(Client $client) {
        if (Auth::user()->id === $client->user_id) {
    
            Client::destroy($client->id);
            return redirect("/clients")->with('success', "Client has been successfully deleted!");
        }
        else {
            redirect('/stats');
        }
    
    }


    //Display all invoices for selected client

    public function allInvoices(Client $client) {

    
        $invoices = Invoice::where('client_id', $client->id)->paginate(5);
        $invoices->load('items');

        if (Auth::user()->id === $client->user_id) {
            return view('clients.invoices', 
            [
                'invoices' => $invoices,
                'client' => $client
            ]);
        } else {
            return redirect('/stats');
        }



    }

}
