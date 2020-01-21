<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLidVansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lid_vans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('verenigingId');
            $table->unsignedBigInteger('gebruikerId');

            $table->foreign('gebruikerId')->references('id')->on('gebruikers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('verenigingId')->references('id')->on('verenigings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lid_vans');
    }
}
