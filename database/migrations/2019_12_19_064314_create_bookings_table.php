<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('event_section_id');
            $table->foreign('event_section_id')->references('id')->on('event_sections')->onDelete('cascade');

            $table->unsignedBigInteger('booking_details_id');
            $table->foreign('booking_details_id')->references('id')->on('booking_details')->onDelete('cascade');

            $table->unsignedBigInteger('payment_id')->nullable();       // todo wieder löschen, wird nicht verwendet
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');

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
        Schema::dropIfExists('bookings');
    }
}
