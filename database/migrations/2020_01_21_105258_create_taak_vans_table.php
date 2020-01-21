<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaakVansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taak_vans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('verenigingId');
            $table->unsignedBigInteger('taakId');

            $table->foreign('verenigingId')->references('id')->on('verenigings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('taakId')->references('id')->on('taaks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taak_vans');
    }
}
