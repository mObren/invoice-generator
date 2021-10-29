<?php
namespace App\Http\Controllers;
use App\Http\Requests\ItemStoreRequest;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Http\Request;
class ItemController extends Controller
{
    public function store(ItemStoreRequest $request)
    {
        $validated = $request->validated();
        $item = Item::create($validated);
        return redirect("/invoices/$item->invoice_id")->with('success', 'Item has been added.');
    }
    public function delete(Item $item)
    {
        $invoice_id = $item->invoice_id;
        Item::destroy($item->id);
        return redirect("/invoices/$invoice_id")->with('success', 'Item has been removed.');
    }
}
