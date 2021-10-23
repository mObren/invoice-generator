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
use Barryvdh\DomPDF\PDF as PDF;

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
        $results = $collection
            ->orderBy('date', 'ASC')
            ->filter(request([
            'search_company', 'search_status', 'search_date_from', 'search_date_to', 'search_valute_from', 'search_valute_to']))
            ->paginate(10);
        foreach ($results as $item) {
                $invoices[] = $item;
            
        }

        return view('invoices.all', [
            'invoices' => $invoices,
            'results' => $results
        ]);   
     }
     
     


     //Display selected invoice in PDF format.
     public function export(Invoice $invoice) {
       
        if($invoice->user()->id === auth()->user()->id) {
       $invoiceDocument = Invoice::getInvoiceForPdf($invoice->id);
    
       return view('templates.invoice', ['invoice' => $invoiceDocument,   'helper' => $invoice ]);
        } else {
            return redirect('/stats');
        }
     }


     //**Download PDF of selected invoice */

     public function downloadPDF(Invoice $invoice) {

        $user = User::getCurrentUser();

        if ($invoice->user()->id === $user->id) {
            $invoiceDocument = Invoice::getInvoiceForPdf($invoice->id);
  
        
            view()->share(['invoice' => $invoiceDocument, 'helper' =>$invoice]);
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('templates.invoice');
            
            return $pdf->download("invoice-" . $invoice->id . ".pdf");
        } 
        else {
            return redirect('/stats');
        }
      
      }

    //Display single invoice with form for adding items
    public function single(Invoice $invoice) {
        if (Auth::user()->id === $invoice->user()->id) {
            return view('invoices.single', [
                'invoice' => $invoice
            ]);
        } else {
            return redirect('/stats');
        }


     

    }
    //Display form for adding invoices
    public function create(Invoice $invoice = null) {
        if($invoice !== null) {
            if (Auth::user()->id === $invoice->user()->id) {
                return view('invoices.create', [
                    'invoice' => $invoice
                ]);
            } else {
                return redirect('/stats');
            }

        } else {
            return view('invoices.create');
        }
    }       

    //Store invoice to database
    public function store(Invoice $invoice = null) {

        if ($invoice !== null) {
            $data = request()->validate([
                'client_id' => 'required',
                'date' => 'required|date',
                'valute' => 'required|date',
            ]);

            if (Auth::user()->id === $invoice->user()->id) {
                $invoice->update($data);
                return redirect("/invoices/$invoice->id")->with('success', 'Invoice has been updated!');
            } else {
                return redirect('/stats');
            }
     

        } else { 

                $data = request()->validate([
                    'client_id' => 'required',
                    'date' => 'required',
                    'valute' => 'required',
                ]);

                $data['status'] = 0;
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
    public function delete(Invoice $invoice) {
        if (Auth::user()->id === $invoice->user()->id) {
    
            Invoice::destroy($invoice->id);
            return redirect("/invoices")->with('success', "Invoice has been successfully deleted!");
        }
        else {
            redirect('/stats');
        }
    
    }


    //Set "is paid" status to oposite of current
    public function changeIsPaidStatus(Invoice $invoice) {
        if ($invoice->status === 0) {
            $data['status'] = 1;
            $data['date_paid'] = date('Y-m-d', strtotime(now()));
            $invoice->update($data);
        return redirect("/invoices/$invoice->id")->with('success', "You set invoice status to: paid!");

        } else {
            $data['status'] = 0;
            $data['date_paid'] = NULL;
            $invoice->update($data);
        return redirect("/invoices/$invoice->id")->with('success', "You set invoice status to: not paid!");

        }
    }
    //Set "is paid" status to oposite of current
    public function toggleStatus(Invoice $invoice) {
        if ($invoice->status === 0) {
            $data['status'] = 1;
            $data['date_paid'] = date('Y-m-d', strtotime(now()));
            $invoice->update($data);
        } else {
            $data['status'] = 0;
            $data['date_paid'] = NULL;
            $invoice->update($data);

        }
        return redirect("/invoices")->with('success', "Invoice's no. $invoice->id status has been changed!");
    }
}
