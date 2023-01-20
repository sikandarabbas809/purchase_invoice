<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoice_headers', function (Blueprint $table) {
            $table->id();
            $table->timestamp('po_date_time');
            $table->string('po_number')->unique();
            $table->bigInteger('supplier_id')->unsigned();
            $table->bigInteger('delivery_location_id')->unsigned();
            $table->decimal('sub_total', 10, 2);
            $table->decimal('tax_total', 10, 2);
            $table->decimal('net_amount', 10, 2);
            $table->decimal('discount_amount', 10, 2);
            $table->timestamp('delivery_date_time')->nullable();
            $table->enum('status', ['purchase', 'return', 'cancel']);
            $table->bigInteger('created_by')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->bigInteger('updated_by')->unsigned();
            $table->timestamp('updated_at')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_invoice_headers');
    }
};
