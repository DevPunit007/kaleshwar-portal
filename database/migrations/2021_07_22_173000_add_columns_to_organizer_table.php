<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOrganizerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizers', function (Blueprint $table) {

            $table->string('organizer_email')->nullable()->after('type');
            $table->string('organizer_website')->nullable()->after('organizer_email');
            $table->boolean('status')->default('2')->after('token');
            $table->boolean('is_visible')->default('0')->after('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
