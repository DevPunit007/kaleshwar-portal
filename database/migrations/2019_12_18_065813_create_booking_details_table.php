<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('arrival_ashram');
            $table->string('departure_ashram');

            $table->string('arrival_india')->nullable();
            $table->string('transportation')->nullable();

            $table->string('roommate_preference')->nullable();

            $table->string('emergency_contact')->nullable();
            $table->string('agreement_to_rules')->nullable();
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
        Schema::dropIfExists('booking_details');
    }
}
