<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionJourneyPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_journey', function (Blueprint $table) {
            $table->integer('collection_id')->unsigned()->index();
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->integer('journey_id')->unsigned()->index();
            $table->foreign('journey_id')->references('id')->on('journeys')->onDelete('cascade');
            $table->primary(['collection_id', 'journey_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('collection_journey');
    }
}
