<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscordRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discord_roles', function (Blueprint $table) {
            $table->id();
            $table->string('friendly_name');
            $table->string('discord_id');
            $table->decimal('modifier',3,2)->default(1.00); // 0 (1) .00 (2) = (3 total / 2 decimal places)
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
        Schema::dropIfExists('discord_roles');
    }
}
