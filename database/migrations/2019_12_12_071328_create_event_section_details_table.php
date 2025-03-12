<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSectionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_section_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('event_section_id');
            $table->foreign('event_section_id')->references('id')->on('event_sections')->onDelete('cascade');

            $table->string('title');
            $table->string('description')->nullable();
            $table->string('language');

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
        Schema::dropIfExists('event_section_details');
    }
}
