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
            $table->integer('truck_id')->index()->unsigned();
            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->integer('zone_id')->index()->unsigned()->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->integer('service_zone_id')->index()->unsigned()->nullable();
            $table->foreign('service_zone_id')->references('id')->on('service_zones');
            $table->float('startpoint_lg', 10, 6)->nullable();
            $table->float('startpoint_lt', 10, 6)->nullable();
            $table->float('endpoint_lg', 10, 6)->nullable();
            $table->float('endpoint_lt', 10, 6)->nullable();
            $table->timestamp('startpoint')->nullable();
            $table->timestamp('endpoint')->nullable();
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
