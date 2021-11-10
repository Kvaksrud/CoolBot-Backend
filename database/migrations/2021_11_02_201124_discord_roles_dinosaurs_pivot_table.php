<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiscordRolesDinosaursPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discord_roles_dinosaurs_pivot_table', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discord_role_id')->index();
            $table->unsignedBigInteger('dinosaur_id')->index();
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
        Schema::dropIfExists('discord_roles_dinosaurs_pivot_table');
    }
}
