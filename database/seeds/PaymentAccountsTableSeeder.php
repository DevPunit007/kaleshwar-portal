<?php

use Illuminate\Database\Seeder;

class PaymentAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_accounts')->insert(
            [
                'id' => '1',
                'name' => 'GLS Germany'
            ]
        );
    }
}
