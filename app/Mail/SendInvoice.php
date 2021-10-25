<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $invoice;
    
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $invoiceDocument = Invoice::getInvoiceForPdf($this->invoice->id);
        view()->share(['invoice' => $invoiceDocument, 'helper' =>$this->invoice]);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('templates.invoice');
        return $this->from(Auth::user()->email, "Invoice no." . $this->invoice->id)
                    ->replyTo(Auth::user()->email, Auth::user()->company_name)
                    ->attachData($pdf->output(), "invoice.pdf")
                    ->view('emails.send-invoice', ['invoice' => $this->invoice]);
    }
}
