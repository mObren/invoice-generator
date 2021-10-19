<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
