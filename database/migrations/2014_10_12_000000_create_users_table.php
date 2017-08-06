<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void

     id(AI), refprof, nom, prénom,  tel, email, adresse, ville, grade, spécialité, IDdépartement, motdepasse
     */
    public function up()
    {
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('refprof');
                $table->string('prenom');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('adress');
                $table->string('ville');
                $table->string('grade');
                $table->string('specialite');
                $table->string('num');
                $table->integer('departement_id')->unsigned()->nullable();

                $table->foreign('departement_id')->references('id')->on('departements');
                $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
