<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert(
            [
                'id' => '1',
                'payment_year' => '2022',
                'payment_date' => '2022-07-25',
                'payment_account_id' => '1',
                'user_id' => '3',
                'reference_type' => 'App\Project',
                'reference_id' => '1',
                'amount_sent',
                'amount_received',
                'payment_part_id',
                'description' => 'Donation',
            ]
        );
    }
}
