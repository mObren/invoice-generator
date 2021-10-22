<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Invoice as InvoiceDocument;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class Invoice extends Model
{
    use HasFactory;


    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    protected $dates = ['date', 'valute'];

    public function client() {
        return $this->belongsTo(Client::class);
    }
    
    public function user() {
        return $this->client->user;
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function scopeFilter($query, array $filters) {

        if (isset($filters['search_company'])) {
            $query->whereRelation('client', 'company_name', 'like', "%" . request('search_company') . "%");
        } 
        if (isset($filters['search_status'])) {
            $query->where('status', request('search_status'));
        }
        if (isset($filters['search_date_from'])) {
            $query->where('date', '>=', request('search_date_from'));
        }
        if (isset($filters['search_date_to'])) {
            $query->where('date', '<=', request('search_date_to'));
        }
        if (isset($filters['search_valute_from'])) {
            $query->where('valute', '>=', request('search_valute_from'));
        }
        if (isset($filters['search_valute_to'])) {
            $query->where('valute', '<=', request('search_valute_to'));
        }
     
    }

    public function getTotal() {
        $total = 0;
        $items = $this->items;
        foreach ($items as $item) {
            $total+= $item->price * $item->quantity;

        }
        return $total;
    }

    public static function getInvoice($id)
    {
       $row = Invoice::findOrFail($id);

     

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
               'reg_number' => $user->registration_number,
   
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
           // ->logo(public_path('vendor/invoices/sample-logo.png'))
           ->template('invoice'); // Plantilla personalizada

           return $invoiceDocument;
    }
   
}
