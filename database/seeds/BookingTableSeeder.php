<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert(
            [
                'id' => '45000',
                'user_id' => '3',
                'event_section_id' => '3',
                'currency' => '2',
                'event_section_price' => '108',
                'payment_id' => null
            ]
        );
    }
}
