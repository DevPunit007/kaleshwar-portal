<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelineMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_media', function (Blueprint $table) {
            $table->bigIncrements('id');
                  
            $table->date('date');
            $table->string('time')->nullable();
            
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('restrict');  
            
            $table->string('content'); 

			$table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('restrict');      
			
			$table->string('location_info')->nullable();

            $table->string('type');
            $table->string('format')->nullable();

            $table->string('speaker')->nullable();
            $table->string('translation')->nullable();
            
            $table->string('quality')->nullable();
            $table->time('duration')->nullable();
            
            
            $table->text('notes')->nullable();
            
			$table->unsignedBigInteger('reference_id')->nullable();
			$table->text('reference_info')->nullable();
			
            
            
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
        Schema::dropIfExists('timeline_media');
    }
}
