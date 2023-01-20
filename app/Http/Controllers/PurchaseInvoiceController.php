<?php

namespace App\Http\Controllers;

// use App\PurchaseInvoice;
use Illuminate\Http\Request;
use App\Http\Requests\StorePurchaseInvoice;
use App\Models\Supplier;
use App\Models\DeliveryLocation;
use App\Models\PurchaseInvoice;
use App\Models\User;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the purchase invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseInvoices = PurchaseInvoice::all();
        
        return view('purchase-invoice.index', compact('purchaseInvoices'));
    }

    /**
     * Show the form for creating a new purchase invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $deliveryLocations = DeliveryLocation::all();
        $users = User::all();
        return view('purchase-invoice.create', compact('suppliers', 'deliveryLocations','users'));
    }

    /**
     * Store a newly created purchase invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseInvoice $request)
    {
        // echo"kjshfjdsa";exit();
        $purchaseInvoice = new PurchaseInvoice();
        $purchaseInvoice->po_date_time = $request->po_date_time;
        $purchaseInvoice->po_number = $request->po_number;
        $purchaseInvoice->supplier_id = $request->supplier_id;
        $purchaseInvoice->delivery_location_id = $request->delivery_location_id;
        $purchaseInvoice->sub_total = $request->sub_total;
        $purchaseInvoice->tax_total = $request->tax_total;
        $purchaseInvoice->net_amount = $request->net_amount;
        $purchaseInvoice->discount_amount = $request->discount_amount;
        $purchaseInvoice->delivery_date_time = $request->delivery_date_time;
        $purchaseInvoice->status = $request->status;
        $purchaseInvoice->created_by = auth()->user()->id;
        $purchaseInvoice->save();

        foreach($request->line_items as $lineItem) {
            $purchaseInvoice->lineItems()->create([
                'po_number' => $purchaseInvoice->po_number,
                'serial_number' => $lineItem['serial_number'],
                'item_details' => $lineItem['item_details'],
                'qty' => $lineItem['qty'],
                'tax_amount' => $lineItem['tax_amount'],
                'sub_amount' => $lineItem['sub_amount'],
                'total_amount' => $lineItem['total_amount']
            ]);
        }

        return redirect()->route('purchase-invoice.index')->with('success', 'Purchase Invoice created successfully');
    }

    /**
     * Show the form for editing the specified purchase invoice.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function edit(PurchaseInvoice $purchaseInvoice)
    {
    $suppliers = Supplier::all();
    $deliveryLocations = DeliveryLocation::all();
    return view('purchase-invoice.edit', compact('purchaseInvoice', 'suppliers', 'deliveryLocations'));
    }
    /**
 * Update the specified purchase invoice in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(StorePurchaseInvoice $request, PurchaseInvoice $purchaseInvoice)
{
    $purchaseInvoice->update($request->validated());
    $purchaseInvoice->lineItems()->delete();
    foreach($request->line_items as $lineItem) {
        $purchaseInvoice->lineItems()->create([
            'po_number' => $purchaseInvoice->po_number,
            'serial_number' => $lineItem['serial_number'],
            'item_details' => $lineItem['item_details'],
            'qty' => $lineItem['qty'],
            'tax_amount' => $lineItem['tax_amount'],
            'sub_amount' => $lineItem['sub_amount'],
            'total_amount' => $lineItem['total_amount']
        ]);
    }
    return redirect()->route('purchase-invoice.index')->with('success', 'Purchase Invoice updated successfully');
}

/**
 * Remove the specified purchase invoice from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy(PurchaseInvoice $purchaseInvoice)
{
    $purchaseInvoice->lineItems()->delete();
    $purchaseInvoice->delete();
    return redirect()->route('purchase-invoice.index')->with('success', 'Purchase Invoice deleted successfully');
}
}