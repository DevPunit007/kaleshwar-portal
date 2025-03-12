<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('booking_details')->insert(
            [
                'booking_id' => '45000',
                'arrival_ashram' => '2020-03-05',
                'departure_ashram' => '2020-03-20',
                'arrival_india' => '2020-03-05',
                'transportation' => 'yes',
                'roommate_preference' => 'Grid',
                'emergency_contact' => 'Horst +491777878300',
                'agreement_to_rules' => 'yes'
            ]
        );
    }
}
