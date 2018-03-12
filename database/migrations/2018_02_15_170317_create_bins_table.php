<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->index();;
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('classification_id')->unsigned()->index();;
            $table->foreign('classification_id')->references('id')->on('classifications');
            $table->biginteger('price')->nullable();
            $table->string('type')->nullable();
            $table->string('desc')->nullable();
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
        Schema::drop('bins');
    }
}
