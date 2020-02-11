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
            $table->string('name');
            $table->string('voornaam');
            $table->string('roepnaam')->nullable();
            $table->dateTime('geboortedatum');
            $table->string('email')->nullable();
            $table->string('telefoon')->nullable();
            $table->string('opmerking')->nullable();
            $table->unsignedBigInteger('rol_id')->nullable();
            $table->string('rijksregisternr')->nullable();
            $table->string('password')->nullable();
            $table->boolean('eersteAanmelding');
            $table->boolean('lunchpakket');
            $table->boolean('actief');
            $table->string('foto')->nullable();

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
