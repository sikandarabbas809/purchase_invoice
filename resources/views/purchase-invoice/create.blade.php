@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('purchase-invoice.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="po_number">PO Number</label>
            <input type="text" class="form-control" id="po_number" name="po_number" value="{{ old('po_number') }}">
            @error('po_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="supplier_id">Supplier</label>
            <select class="form-control" id="supplier_id" name="supplier_id">
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                @endforeach
            </select>
            @error('supplier_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="delivery_location_id">Delivery Location</label>
            <select class="form-control selectpicker" id="delivery_location_id" name="delivery_location_id" multiple>
                @foreach($deliveryLocations as $deliveryLocation)
                <option value="{{ $deliveryLocation->id }}" {{ in_array($deliveryLocation->id, old('delivery_location_id', [])) ? 'selected' : '' }}>{{ $deliveryLocation->location }}</option>
                @endforeach
            </select>
            @error('delivery_location_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="sub_total">Sub Total</label>
            <input type="text" class="form-control" id="sub_total" name="sub_total" value="{{ old('sub_total') }}">
            @error('sub_total')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tax_total">Tax Total</label>
            <input type="text" class="form-control" id="tax_total" name="tax_total" value="{{ old('tax_total') }}">
            @error('tax_total')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="net_amount">Net Amount</label>
            <input type="text" class="form-control" id="net_amount" name="net_amount" value="{{ old('net_amount') }}">
            @error('net_amount')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="discount_amount">Discount Amount</label>
            <input type="text" class="form-control" id="discount_amount" name="discount_amount" value="{{ old('discount_amount') }}">
            @error('discount_amount')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="delivery_date_time">Delivery Date & Time</label>
            <input type="text" class="form-control" id="delivery_date_time" name="delivery_date_time" value="{{ old('delivery_date_time') }}">
            @error('delivery_date_time')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="purchase" {{ old('status') == 'purchase' ? 'selected' : '' }}>Purchase</option>
                <option value="return" {{ old('status') == 'return' ? 'selected' : '' }}>Return</option>
                <option value="cancel" {{ old('status') == 'cancel' ? 'selected' : '' }}>Cancel</option>
            </select>
            @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="created_by">Created By</label>
            <select class="form-control" id="created_by" name="created_by">
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('created_by') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('created_by')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Line Items</label>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item Details</th>
                        <th>Qty</th>
                        <th>Tax Amount</th>
                        <th>Sub Amount</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < count(old('line_items', [])); $i++) <tr>
                        <td>
                            <input type="text" class="form-control" name="line_items[{{ $i }}][item_details]" value="{{ old("line_items.$i.item_details") }}">
                            @error("line_items.$i.item_details")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="line_items[{{ $i }}][qty]" value="{{ old("line_items.$i.qty") }}">
                            @error("line_items.$i.qty")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="line_items[{{ $i}}][tax_amount]" value="{{ old("line_items.$i.tax_amount") }}">
                            @error("line_items.$i.tax_amount")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="line_items[{{ $i }}][sub_amount]" value="{{ old("line_items.$i.sub_amount") }}">
                            @error("line_items.$i.sub_amount")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" name="line_items[{{ $i }}][total_amount]" value="{{ old("line_items.$i.total_amount") }}">
                            @error("line_items.$i.total_amount")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>

    </form>
</div>
@endsection