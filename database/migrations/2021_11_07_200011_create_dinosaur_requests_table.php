<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinosaurRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinosaur_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discord_registration_id');
            $table->unsignedBigInteger('requestable_id');
            $table->string('requestable_type')->comment('App\Dinosaur, App\Teleport etc.');
            $table->integer('cost')->comment('Cost of request at execution');
            $table->json('sheet')->comment('JSON content injected to server');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('dinosaur_requests');
    }
}
