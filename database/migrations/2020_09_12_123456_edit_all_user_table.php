<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use doctrine\dbal\lib\Doctrine\DBAL\Driver;

class EditAllUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('user_contact_information', function (Blueprint $table) {

            $table->renameColumn('user_id', 'id');
            $table->primary('id');
            $table->dropUnique('user_id');
        });
        Schema::table('user_personal_information', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
            $table->primary('id');
            $table->dropUnique('user_id');
        });
        Schema::table('user_spiritual_histories', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
            $table->primary('id');
            $table->dropUnique('user_id');
        });
        Schema::table('user_ashram_data', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
            $table->primary('id');
            $table->dropUnique('user_id');
        });*/
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
