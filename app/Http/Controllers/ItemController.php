<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function store()
    {
        $data = request()->validate([
            'invoice_id' => 'required',
            'service' => 'required',
            'quantity' => 'required|numeric|gt:0',
            'price' => 'required|numeric|gt:0',
            'pdv' => 'required|numeric|gt:0',
        ]);

        $item = Item::create($data);
        return redirect("/invoices/$item->invoice_id")->with('success', 'Item has been added.');
    }
    public function delete($id)
    {
        $item = Item::find($id);
        $invoice_id = $item->invoice_id;
        Item::destroy($id);

        return redirect("/invoices/$invoice_id")->with('success', 'Item has been removed.');
    }

}

