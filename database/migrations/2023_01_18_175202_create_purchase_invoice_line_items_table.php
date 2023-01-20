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
        Schema::create('purchase_invoice_line_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('po_number')->unsigned();
            $table->string('serial_number')->unique();
            $table->string('item_details');
            $table->integer('qty');
            $table->decimal('tax_amount', 10, 2);
            $table->decimal('sub_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_invoice_line_items');
    }
};
