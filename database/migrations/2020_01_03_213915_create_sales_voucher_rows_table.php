<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesVoucherRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_voucher_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sales_voucher_id')->references('id')->on('sales_vouchers');
            $table->bigInteger('product_id')->references('id')->on('products');
            $table->decimal('qty', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_voucher_rows');
    }
}
