<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGebruikersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gebruikers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('naam');
            $table->string('voornaam');
            $table->string('roepnaam');
            $table->string('straat');
            $table->string('huisnummer');
            $table->dateTime('geboortedatum');
            $table->string('emailadres');
            $table->string('telefoon');
            $table->boolean('2detshirt');
            $table->string('opmerking');
            $table->string('rijksregisternr');
            $table->string('postcode');
            $table->string('wachtwoord');
            $table->boolean('eersteAanmelding');
            $table->boolean('lunchpakket');
            $table->boolean('actief');
            $table->string('qrcode');
            $table->string('foto');
            $table->unsignedBigInteger('tshirtId');
            $table->unsignedBigInteger('rolId');

            $table->foreign('tshirtId')->references('id')->on('tshirts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rolId')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gebruikers');
    }
}
