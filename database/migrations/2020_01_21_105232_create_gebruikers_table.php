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
            $table->boolean('tweedetshirt')->nullable();
            $table->string('opmerking');
            $table->string('rijksregisternr');
            $table->string('postcode');
            $table->string('wachtwoord')->nullable();
            $table->boolean('eersteAanmelding');
            $table->boolean('lunchpakket');
            $table->boolean('actief')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('tshirt_id')->nullable();
            $table->unsignedBigInteger('rol_id')->nullable();

            // $table->foreign('tshirtId')->references('id')->on('tshirts')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('rolId')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
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
