<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaakVerenigingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taak_vereniging', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vereniging_id');
            $table->unsignedBigInteger('taak_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taak_vereniging');
    }
}
