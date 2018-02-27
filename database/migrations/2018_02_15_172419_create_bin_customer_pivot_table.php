<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createBinCustomerPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bin_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bin_id')->unsigned()->index();
            $table->foreign('bin_id')->references('id')->on('bins')->onDelete('cascade');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bin_customer');
    }
}
