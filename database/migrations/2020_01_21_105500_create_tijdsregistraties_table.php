<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTijdsregistratiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tijdsregistraties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('checkIn')->nullable();
            $table->dateTime('checkUit')->nullable();
            $table->unsignedBigInteger('gebruiker_id');
            //$table->foreign('gebruikerId')->references('id')->on('gebruikers')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tijdsregistraties');
    }
}
