<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function index() {
        $clients = Client::fetchAllClients();     
        return view('clients.all', ['clients' => $clients] );
    }

    public function single($id) {

        $client = Client::findOrfail($id);
        if (Auth::user()->id === $client->user_id) {
            return view('clients.single', [
                'client' => $client
            ]);
        }
        else 
        {
            return redirect('/');
        }

    
    }

    public function create($id = null) {
        if($id !== null) {
            $client = Client::find($id);
            if (Auth::user()->id === $client->user_id) {
                return view('clients.create', [
                    'client' => $client
                ]);
            } else {
                return redirect('/');
            }

        } else {
            return view('clients.create');
        }
    }

    public function store($id = null) {

       

        if ($id !== null) {
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
            $client = Client::find($id);
            if (Auth::user()->id === $client->user_id) {
                $client->update($data);
                return redirect("/clients/$id")->with('success', 'Client profile has been updated!');
            } else {
                return redirect('/');
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

    public function delete($id) {
        $client = Client::find($id);
        if (Auth::user()->id === $client->user_id) {
    
            Client::destroy($id);
            return redirect("/clients")->with('success', "Client has been successfully deleted!");
        }
        else {
            redirect('/');
        }
    
    }


    //Display all invoices for selected client

    public function allInvoices($id) {

        $client = Client::find($id);
        $invoices = Invoice::where('client_id', $id)->paginate(5);
        $invoices->load('items');

        if (Auth::user()->id === $client->user_id) {
            return view('clients.invoices', 
            [
                'invoices' => $invoices,
                'client' => $client
            ]);
        } else {
            return redirect('/');
        }



    }

}
