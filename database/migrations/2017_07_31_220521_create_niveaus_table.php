<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNiveausTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveaus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('abbreviation');
            $table->integer('nbg');
            $table->integer('filiere_id')->unsigned();

            $table->foreign('filiere_id')->references('id')->on('filieres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveaus');
    }
}
