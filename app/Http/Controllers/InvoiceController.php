<?php
namespace App\Http\Controllers;
use App\Http\Requests\InvoiceStoreRequest;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use Illuminate\Validation\Rules\In;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Support\Facades\Redirect;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $userId = Auth::user()->id;
        $collection = Invoice::with(['client:id,company_name', 'items'])
        ->whereRelation('client', 'user_id', '=', $userId);
        
        //dd(request('search_status'));
        $invoices = $collection
            ->orderBy('date', 'ASC')
            ->filter(request([
            'search_company', 'search_status', 'search_date_from', 'search_date_to', 'search_valute_from', 'search_valute_to']))
            ->paginate(10);
 
        return view('invoices.all', [
            'invoices' => $invoices->withQueryString(),
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
    
    //Display form for creating invoice for targeted client
    public function addToClient(Client $client) {
        if (Auth::user()->id === $client->user_id)
        {
            return view('invoices.add-to-client', ['client' => $client]);
        } else {
            return redirect('/stats');
        }
    }
    //Store invoice for targeted client
    public  function addInvoiceToClient(Client $client, InvoiceStoreRequest $request) {
        if (Auth::user()->id === $client->user_id) {
            $validated = $request->validated();
            $invoice = Invoice::create($validated);
            return redirect("/invoices/$invoice->id")->with('success', 'Invoice has been updated!');
            
        } else {
            return redirect('/stats');
        }
    }
    //Store invoice to database
    public function store(Invoice $invoice = null, InvoiceStoreRequest $request) {
        if ($invoice !== null) {
            $validated = $request->validated();
            if (Auth::user()->id === $invoice->user()->id) {
                $invoice->update($validated);
                return redirect("/invoices/$invoice->id")->with('success', 'Invoice has been updated!');
            } else {
                return redirect('/stats');
            }
     
        } else { 
                $validated = $request->validated();
                $validated['status'] = 0;
                $invoice = Invoice::create($validated);
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
        if (Auth::user()->id === $invoice->user()->id) {
            if ($invoice->status === 0) {
                $data['status'] = 1;
                $data['date_paid'] = date('Y-m-d', strtotime(now()));
                $invoice->update($data);
            return Redirect::back()->with('success',"You set invoice no. $invoice->id status to: paid!");
    
            } else {
                $data['status'] = 0;
                $data['date_paid'] = NULL;
                $invoice->update($data);
           return Redirect::back()->with('success',"You set invoice no. $invoice->id status to: not paid!");
            }
        } else {
            return redirect('/');
        }
       
    }
}
