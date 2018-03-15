<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all bills
        $invoices = Invoice::where('company_id', Auth::user()->company_id)
                    ->orderBy('id', 'desc')
                    ->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //redirect to create invoice page
        $customers = Customer::where('company_id', Auth::user()->company_id)
                    ->get();
        $collections = Collection::where('company_id', Auth::user()->company_id)
                    ->get();

        return view('invoices.create', compact('customers', 'collections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create an invoice 
        $validateData = $request->validate([
            'collection' => 'required|integer',
            'customer' => 'required|integer',
            'amount' => 'required',
            'due_date' => 'nullable',
            'status' => 'nullable'
        ]);
        
        $record = Invoice::latest()->orderBy('id', 'DESC')->first();
        if($record){
            $splitString = explode("-",$record->number);
            $code = $splitString[1] + 1;
            $increment = $code;
            $increment++;
            $nextInvoiceNumber = $splitString[0].'-'.$increment;
            
        } else{
            $string = 'INVOICE';
            $number = 1011;
            $nextInvoiceNumber = 'INVOICE-'.$number;
        }
       
        $invoice = new Invoice;
        $invoice->collection_id = $request->collection;
        $invoice->company_id = Auth::user()->company_id;
        $invoice->customer = $request->customer;
        $invoice->amount = $request->amount;
        $invoice->status = $request->status;
        $invoice->number = $nextInvoiceNumber;
        $invoice->save();

        return redirect('invoices.index')->with('status', 'Invoice successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a single invoice
        $invoice = Invoice::where('company_id', Auth::user()->company_id)
                    ->where('id', $id)
                    ->first();
        return view('invoices.show')->with('collection', 'customer');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //edit an invoice
        $invoice = Invoice::where('company_id', Auth::user()->company_id)
                    ->where('id', $id)
                    ->first();
        $customers = Customer::where('company_id', Auth::user()->company_id)
                    ->get();
        $collections = Collection::where('company_id', Auth::user()->company_id)
                    ->get();

        return view('invoices.edit', compact('customers', 'collections'));
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
        //validate and update
        $validateData = $request->validate([
            'collection' => 'required|integer',
            'customer' => 'required|integer',
            'amount' => 'required',
            'due_date' => 'nullable',
            'status' => 'nullable'
        ]);

        $invoice = new Invoice;
        $invoice->collection_id = $request->collection;
        $invoice->company_id = Auth::user()->company_id;
        $invoice->customer = $request->customer;
        $invoice->amount = $request->amount;
        $invoice->status = $request->status;
        $invoice->number = $nextInvoiceNumber;
        $invoice->save();
        
        return redirect('invoices.index')->with('status', 'Invoice Updated Successuflly');
    }

    public function generate_invoice()
    {
        //get all invoices within a month 
        $customers = Customer::where('company_id', Auth::user()->company_id)
                               ->get();
        foreach ($customers as $customer) {
            $invoices = Invoice::where('company_id', Auth::user()->company_id)
            ->where('customer_id', $customer->id)
            ->whereBetween(
                'created_at', [
                    $current->startOfMonth()->toDateTimeString(),
                    $current->endOfMonth()->toDateTimeString()
                 ]
             )->get('price')->sum();
         
        
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete an invoice
        $invoice = Invoice::where('company_id', Auth::user()->company_id)
                    ->where('id', $id)
                    ->first();
        $invoice->destroy($invoice->id);

        return redirect(invoices.index)->with('status', 'Invoice Successfully Deleted');

    }
}
