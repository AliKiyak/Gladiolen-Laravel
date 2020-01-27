<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementverenigingTaakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenementvereniging_taak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evenementvereniging_id');
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
        Schema::dropIfExists('evenementvereniging_taak');
    }
}
