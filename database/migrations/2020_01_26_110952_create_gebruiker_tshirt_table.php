<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGebruikerTshirtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gebruiker_tshirt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gebruiker_id');
            $table->unsignedBigInteger('tshirt_id');
            $table->integer('aantal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gebruiker_tshirt');
    }
}
