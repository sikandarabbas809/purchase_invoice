@extends('layouts.app')
@section('content')
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>PO Number</th>
                <th>Supplier</th>
                <th>Delivery Location</th>
                <th>Sub Total</th>
                <th>Tax Total</th>
                <th>Net Amount</th>
                <th>Discount Amount</th>
                <th>Delivery Date & Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseInvoices as $purchaseInvoice)
            <tr>
                <td>{{ $purchaseInvoice->po_number }}</td>
                <td>{{ $purchaseInvoice->supplier->name }}</td>
                <td>{{ $purchaseInvoice->deliveryLocation->name }}</td>
                <td>{{ $purchaseInvoice->sub_total }}</td>
                <td>{{ $purchaseInvoice->tax_total }}</td>
                <td>{{ $purchaseInvoice->net_amount }}</td>
                <td>{{ $purchaseInvoice->discount_amount }}</td>
                <td>{{ $purchaseInvoice->delivery_date_time }}</td>
                <td>{{ $purchaseInvoice->status }}</td>
                <td>
                    <a href="{{ route('purchase-invoice.edit', $purchaseInvoice->id) }}" class="btn btn-secondary">Edit</a>
                    <a href="{{ route('purchase-invoice.destroy', $purchaseInvoice->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this purchase invoice?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection