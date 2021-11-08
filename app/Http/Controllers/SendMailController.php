<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Mail\SendInvoice;
use Illuminate\Support\Facades\Mail;
class SendMailController extends Controller
{
    public function send(Invoice $invoice) {
        
    Mail::to($invoice->client->email)
        ->send(new SendInvoice($invoice));
    return redirect("/invoices/$invoice->id")->with('success', 'Mail sent successfuly!');
    }
}
