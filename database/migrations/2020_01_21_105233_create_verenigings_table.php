<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerenigingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verenigings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('naam');
            $table->unsignedBigInteger('hoofdverantwoordelijke');
            $table->unsignedBigInteger('tweedeverantwoordelijke')->nullable();
            $table->unsignedBigInteger('contactpersoon')->nullable();
            $table->string('rekeningnr');
            $table->string('btwnr');
            $table->string('straat');
            $table->string('huisnummer');
            $table->string('gemeente');
            $table->string('postcode');
            $table->boolean('actief');

            //$table->foreign('hoofdverantwoordelijke')->references('id')->on('gebruikers')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('2deverantwoordelijke')->references('id')->on('verenigings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verenigings');
    }
}
