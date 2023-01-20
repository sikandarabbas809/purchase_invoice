<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    protected $table = 'delivery_locations';
    public function purchaseInvoices()
    {
        return $this->hasMany(PurchaseInvoice::class, 'delivery_location_id', 'id');
    }
}
