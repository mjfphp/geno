<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevesTable extends Migration
{

    public function up()
    {
        if(!Schema::hasTable('eleves'))
        {
            Schema::create('eleves', function (Blueprint $table) {
                $table->increments('id');
                $table->string('apoge');
                $table->string('cne')->unique();
                $table->string('cin')->unique();
                $table->string('email')->unique()->nullable();
                $table->string('nom');
                $table->string('prenom');
                $table->string('password')->nullable();
                $table->string('date_naissance');
                $table->string('lieu_naissance');
                $table->string('ville');
                $table->integer('num');
                $table->integer('grp');
                $table->string('statut');
                $table->integer('niveau_id')->unsigned();

                $table->foreign('niveau_id')->references('id')->on('niveaus');
                $table->timestamps();
            });
        }
    }



    public function down()
    {
        Schema::dropIfExists('eleves');
    }
}
