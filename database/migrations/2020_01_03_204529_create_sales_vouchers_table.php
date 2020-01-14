<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('voucher_no');
            $table->bigInteger('customer_id')->references('id')->on('customers');
            $table->date('create_date');
            $table->tinyInteger('deleted')->default(false);
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
        Schema::dropIfExists('sales_vouchers');
    }
}
