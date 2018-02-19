<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->index();;
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('zone_id')->nullable()->unsigned()->index();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->integer('service_zone_id')->unsigned()->index()->nullable();
            $table->foreign('service_zone_id')->references('id')->on('service_zones');
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('phone');
            $table->integer('phone2')->nullable();
            $table->string('address')->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->bigInteger('radius')->nullable();
            $table->integer('location_active')->nullable();
            $table->integer('frequency')->nullable();
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
        Schema::drop('customers');
    }
}
