<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditBookingsAndDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->text('booking_message')->after('event_section_id')->nullable();
            $table->dropForeign('bookings_booking_details_id_foreign');
            $table->dropColumn('booking_details_id');
        });

        Schema::table('booking_details', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->after('id');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
