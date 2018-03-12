<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->index();;
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('name');
            $table->string('email')->nullable()->unique()->nullable();
            $table->string('password')->nullable();
            $table->BigInteger('phone1')->nullable();
            $table->BigInteger('phone2')->nullable();
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('drivers');
    }
}
