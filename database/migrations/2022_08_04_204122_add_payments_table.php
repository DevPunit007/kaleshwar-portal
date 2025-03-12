<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->string('payment_year', 4)->after('id');
            $table->date('payment_date')->after('payment_year');

            $table->unsignedBigInteger('payment_account_id')->after('payment_date');
            $table->foreign('payment_account_id')->references('id')->on('payment_accounts')->onDelete('restrict');

            $table->unsignedBigInteger('user_id')->nullable()->after('payment_account_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

            $table->string('reference_type')->after('user_id');
            $table->unsignedBigInteger('reference_id')->after('reference_type');

            $table->integer('amount_sent')->after('reference_id');
            $table->integer('amount_received')->after('amount_sent');

            $table->integer('payment_part_id')->after('amount_received')->nullable();

            $table->string('description')->after('payment_part_id')->nullable();
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
