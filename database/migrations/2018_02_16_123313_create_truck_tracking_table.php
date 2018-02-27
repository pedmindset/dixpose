<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTruckTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_tracking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('truck_id')->unsigned()->index();
            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->integer('journey_id')->unsigned()->index();
            $table->foreign('journey_id')->references('id')->on('journeys');
            $table->float('longitude', 10, 6)->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->string('speed')->nullable();
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
        Schema::drop('truck_tracking');
    }
}
