<?php

namespace App\Http\Controllers;

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
    public function store(Client $client = null) {

       

        if ($client !== null) {
            $data = request()->validate([
                'company_name' => 'required|max:255',
                'email' => 'required|email',
                'address' => 'required',
                'city' => 'required|max:255',
                'country' => 'required|max:255',
                'registration_number' => 'required',
                'tax_number' => 'required',
                'zip_code' => 'required'
            ]);

            if (Auth::user()->id === $client->user_id) {
                $client->update($data);
                return redirect("/clients/$client->id")->with('success', 'Client profile has been updated!');
            } else {
                return redirect('/stats');
            }
     

        } else { 

        $userId = auth()->user()->id;
        $data = request()->validate([
            'company_name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'registration_number' => 'required',
            'tax_number' => 'required',
            'zip_code' => 'required'
        ]);
        $data['user_id'] = $userId;

        Client::create($data);
        return redirect("/clients")->with('success', "New client has been successfully created!");
        }
    }

    public function delete(Client $client) {
        if (Auth::user()->id === $client->user_id) {
    
            $client->delete();
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
