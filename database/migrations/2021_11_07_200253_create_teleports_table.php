<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeleportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teleports', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('code');
            $table->integer('cost');
            $table->json('sheet')->comment('Coordinates injected into character sheet');
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
        Schema::dropIfExists('teleports');
    }
}
