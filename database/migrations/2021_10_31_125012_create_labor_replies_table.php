<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discord_registration_id');
            $table->string('status')->default('new'); // new|declined|approved
            $table->unsignedBigInteger('status_updated_by_user_id')->nullable()->default(null);
            $table->string('status_comment')->nullable()->default(null);
            $table->timestampTz('last_status_change')->nullable()->default(null);
            $table->string('text_before');
            $table->string('text_after');
            $table->string('target'); // wallet/balance
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
        Schema::dropIfExists('labor_replies');
    }
}
