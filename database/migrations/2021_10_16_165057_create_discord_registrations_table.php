<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscordRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discord_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('guild_id')->index(); // needs to be string because its a long number and JSON does not support long numbers
            $table->string('member_id')->index();
            $table->string('steam_id')->index();
            $table->string('username');
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
        Schema::dropIfExists('discord_registrations');
    }
}
