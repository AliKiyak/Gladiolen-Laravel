<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGebruikerVerenigingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gebruiker_vereniging', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vereniging_id');
            $table->unsignedBigInteger('gebruiker_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gebruiker_vereniging');
    }
}
