<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('modules'))
        {
            Schema::create('modules', function (Blueprint $table) {
                $table->increments('id');
                $table->string('intitule');
                $table->string('abbreviation');
                $table->float('vh');
                $table->string('nature');
                $table->string('semestre');
                $table->integer('niveau_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->integer('departement_id')->unsigned()->nullable();

                $table->foreign('departement_id')->references('id')->on('departements');
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('niveau_id')->references('id')->on('niveaus');


                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
