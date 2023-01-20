<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $table = 'purchase_invoice_headers';

    public function lineItems()
    {
        return $this->hasMany(PurchaseInvoiceLineItem::class, 'po_number', 'po_number');
    }
}
