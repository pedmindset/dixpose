<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerValidateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_validate_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('collection_id')->index()->unsigned();
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->integer('customer_id')->index()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('company_id')->unsigned()->index();;
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('status')->nullable();
            $table->text('remarks')->nullable();
            $table->softDeletes();
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
        Schema::drop('customer_validate_collections');
    }
}
