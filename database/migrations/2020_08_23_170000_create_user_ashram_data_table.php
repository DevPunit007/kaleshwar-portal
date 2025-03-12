<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAshramDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ashram_data', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');

            $table->string('user_status')->nullable();
            $table->boolean('newsletter')->nullable();
            $table->boolean('attend_ie2011')->nullable();
            $table->text('comments')->nullable();
            $table->integer('reference')->nullable();

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
        Schema::dropIfExists('user_ashram_data');
    }
}
