<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('matieres'))
        {
            Schema::create('matieres', function (Blueprint $table) {
                $table->increments('id');
                $table->string('intitule');
                $table->float('pourcentage');
                $table->float('vh');
                $table->integer('grp');
                $table->integer('user_id')->unsigned()->nullable();
                $table->integer('module_id')->unsigned()->nullable();

                $table->foreign('module_id')->references('id')->on('modules');
                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('matieres');
    }
}
