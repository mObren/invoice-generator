<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use Illuminate\Validation\Rules\In;
use LaravelDaily\Invoices\Invoice as InvoiceDocument;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $invoices = [];
        $userId = Auth::user()->id;
        $collection = Invoice::with(['client:id,company_name', 'items'])
        ->whereRelation('client', 'user_id', '=', $userId);
   
        //dd(request('search_status'));
        $results = $collection->orderBy('date', 'ASC')->filter(request([
            'search_company', 'search_status', 'search_date_from', 'search_date_to', 'search_valute_from', 'search_valute_to']))->paginate(10);
        foreach ($results as $item) {
                $invoices[] = $item;
            
        }

        return view('invoices.all', [
            'invoices' => $invoices,
            'results' => $results
        ]);   
     }
     public function export($id) {
        $row = Invoice::find($id);
        $invoice = $row->load(['items', 'client']);

        $user = User::find(Auth::user()->id);

        // dd($user->company_name);

        $seller = new Party([
            'name' => $user->company_name,
            'code' => $user->zip_code,
            'address' => $user->address . ',' . $user->city,
            'phone' => $user->phone_number,
            'email' => $user->email,
            'vat' => $user->tax_number,
            'account_number' => $user->current_account,
        ]);
        $customer = new Party([
            'name' => $invoice->client->company_name,
            'code' => $invoice->client->zip_code,
            'address' => $invoice->client->address,
            'city' => $invoice->client->city,
            'country' => $invoice->client->country,
            'email' => $invoice->client->email,
            'registration_number' => $invoice->client->registration_number,
            'vat' => $invoice->client->tax_number
        ]);

        $items = collect();
        $invoice->items->each(function ($invoice_item) use (&$items) {
            $item = new InvoiceItem();
            $item->title($invoice_item->service)
                ->pricePerUnit($invoice_item->price)
                ->subTotalPrice( $invoice_item->price * $invoice_item->quantity)
                ->tax($invoice_item->pdv)
                ->quantity($invoice_item->quantity);
    
            $items->push($item);
        });

        $invoiceDocument = InvoiceDocument::make('receipt')
        ->sequence($invoice->id)
        ->serialNumberFormat('{SEQUENCE}')
        ->seller($seller)
        ->buyer($customer)
        ->date($invoice->date)
        ->dateFormat('m/d/Y')
        ->payUntilDays(strtotime($invoice->valute))
        ->currencySymbol('rsd') ->currencyCode('RSD')
        ->currencyFormat('{SYMBOL} {VALUE}')
        ->currencyThousandsSeparator('.')
        ->currencyDecimalPoint(',')
        ->filename($invoice->id)
        ->addItems($items->toArray())
        ->logo(public_path('vendor/invoices/sample-logo.png'))
        ->template('invoice'); // Plantilla personalizada

        // dd($items);

   return view('templates.invoice', ['invoice' => $invoiceDocument,   'helper' => $invoice ]);
     }


    public function single($id) {


        $collection = Invoice::with('items')->where('id', $id)->get();
        $invoice = $collection[0];
        if (Auth::user()->id === $invoice->user()->id) {
            return view('invoices.single', [
                'invoice' => $invoice
            ]);
        } else {
            return redirect('/');
        }


     

    }

    public function create($id = null) {
        if($id !== null) {
            $invoice = Invoice::find($id);
            if (Auth::user()->id === $invoice->user()->id) {
                return view('invoices.create', [
                    'invoice' => $invoice
                ]);
            } else {
                return redirect('/');
            }

        } else {
            return view('invoices.create');
        }
    }

    public function store($id = null) {

        if ($id !== null) {
            $data = request()->validate([
                'client_id' => 'required',
                'date' => 'required|date',
                'valute' => 'required|date',
                'status' => 'required|boolean'
            ]);

            
            $invoice = Invoice::find($id);

            if (Auth::user()->id === $invoice->user()->id) {
                $invoice->update($data);
                return redirect("/invoices/$id")->with('success', 'Invoice has been updated!');
            } else {
                return redirect('/');
            }
     

        } else { 

        $data = request()->validate([
            'client_id' => 'required',
            'date' => 'required',
            'valute' => 'required',
            'status' => 'required|boolean'
        ]);
        // $data['date'] = date('Y-m-d', time());
        // $data['valute'] =  date('Y-m-d', time());
        

        $invoice = Invoice::create($data);

        return redirect("/invoices/$invoice->id")->with('success', "New invoice has been successfully created!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $invoice = Invoice::find($id);
        if (Auth::user()->id === $invoice->user()->id) {
    
            Invoice::destroy($id);
            return redirect("/invoices")->with('success', "Invoice has been successfully deleted!");
        }
        else {
            redirect('/');
        }
    
    }
    public function changeIsPaidStatus($id) {
        $invoice = Invoice::find($id);
        if ($invoice->status === 0) {
            $data['status'] = 1;
            $invoice->update($data);
        return redirect("/invoices/$invoice->id")->with('success', "You set invoice status to: paid!");

        } else {
            $data['status'] = 0;
            $invoice->update($data);
        return redirect("/invoices/$invoice->id")->with('success', "You set invoice status to: not paid!");

        }
    }
    public function toggleStatus($id) {
        $invoice = Invoice::find($id);
        if ($invoice->status === 0) {
            $data['status'] = 1;
            $invoice->update($data);
        } else {
            $data['status'] = 0;
            $invoice->update($data);

        }
        return redirect("/invoices")->with('success', "Invoice's no. $invoice->id status has been changed!");
    }
}
