<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJourneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->index()->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('supervisor_id')->index()->unsigned();
            $table->foreign('supervisor_id')->references('id')->on('supervisors');
            $table->integer('driver_id')->index()->unsigned();
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->integer('truck_id')->index()->unsigned();
            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->integer('service_zone_id')->index()->unsigned()->nullable();
            $table->foreign('service_zone_id')->references('id')->on('service_zones');
            $table->float('startpoint_lg', 10, 6)->nullable();
            $table->float('startpoint_lt', 10, 6)->nullable();
            $table->float('endpoint_lg', 10, 6)->nullable();
            $table->float('endpoint_lt', 10, 6)->nullable();
            $table->dateTime('startpoint')->nullable();
            $table->dateTime('endpoint')->nullable();
            $table->dateTime('pickupdate')->nullable();
            $table->string('status')->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->string('speed')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::drop('journeys');
    }
}
