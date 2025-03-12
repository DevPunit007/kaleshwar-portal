<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSpiritualHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '1',
                'first_meet' => 'by myself',
                'events_kaleshwar' => 'many',
                'processes_kaleshwar' => 'many',
                'ashram_visited' => '1'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '2',
                'first_meet' => null,
                'events_kaleshwar' => null,
                'processes_kaleshwar' => null,
                'ashram_visited' => '1'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '3',
                'first_meet' => 'Großbarkau 2003',
                'events_kaleshwar' => 'many programs',
                'processes_kaleshwar' => 'Five Elements, Sri Chakra, Vaastu',
                'ashram_visited' => '1'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '4',
                'first_meet' => 'Shivarathri 2012',
                'events_kaleshwar' => 'Shivarathri 2012',
                'processes_kaleshwar' => 'Five Elements',
                'ashram_visited' => '1'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '5',
                'first_meet' => null,
                'events_kaleshwar' => null,
                'processes_kaleshwar' => null,
                'ashram_visited' => '1'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '6',
                'first_meet' => null,
                'events_kaleshwar' => null,
                'processes_kaleshwar' => null,
                'ashram_visited' => '1'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '7',
                'first_meet' => null,
                'events_kaleshwar' => null,
                'processes_kaleshwar' => null,
                'ashram_visited' => '1'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '8',
                'first_meet' => null,
                'events_kaleshwar' => null,
                'processes_kaleshwar' => null,
                'ashram_visited' => '1'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '9',
                'first_meet' => null,
                'events_kaleshwar' => null,
                'processes_kaleshwar' => null,
                'ashram_visited' => '0'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '10',
                'first_meet' => null,
                'events_kaleshwar' => null,
                'processes_kaleshwar' => null,
                'ashram_visited' => '0'
            ]
        );

        DB::table('user_spiritual_histories')->insert(
            [
                'id' => '11',
                'first_meet' => 'at the website',
                'events_kaleshwar' => 'none',
                'processes_kaleshwar' => 'none',
                'ashram_visited' => '0'
            ]
        );
    }
}
