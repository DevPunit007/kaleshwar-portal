<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUserFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('user_files', 'files');
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign('user_files_user_id_foreign');
            $table->dropIndex('user_files_user_id_foreign');
            $table->string('date_as_string')->after('type');
            $table->string('file_location', '10')->after('date_as_string');
            $table->string('reference_type')->after('file_extension');
            $table->unsignedBigInteger('reference_id')->after('reference_type');
            $table->renameColumn('user_id', 'uploader_id');
            //$table->unsignedBigInteger('uploader_id')->after('file_extension');
            $table->foreign('uploader_id')->references('id')->on('users');
            $table->softDeletes()->after('updated_at');
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
