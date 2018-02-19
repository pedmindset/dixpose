<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('zone_id')->unsigned()->index()->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->integer('service_zone_id')->unsigned()->index()->nullable();
            $table->foreign('service_zone_id')->references('id')->on('service_zones');
            $table->string('name');
            $table->string('truck_number')->unique();
            $table->string('type')->nullable();
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
        Schema::drop('trucks');
    }
}
