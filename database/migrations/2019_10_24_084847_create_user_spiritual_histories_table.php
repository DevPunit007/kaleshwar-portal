<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSpiritualHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_spiritual_histories', function (Blueprint $table) {

            $table->unsignedBigInteger('id')->unique();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');

            $table->string('first_meet')->nullable();
            $table->text('events_kaleshwar')->nullable();
            $table->text('processes_kaleshwar')->nullable();
            $table->boolean('ashram_visited')->nullable();
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
        Schema::dropIfExists('user_spiritual_histories');
    }
}
