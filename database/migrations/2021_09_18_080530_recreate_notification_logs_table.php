<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateNotificationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('notification_logs');

        Schema::create('notification_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('reference_type');
            $table->unsignedBigInteger('reference_id');

            $table->string('reason');
            $table->text('result');

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
        Schema::dropIfExists('notification_logs');

        Schema::create('notification_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('notification_source');
            $table->string('status');
            $table->text('result');
            $table->timestamps();
        });
    }
}
