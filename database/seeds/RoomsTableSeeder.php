<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => null,
            'name' => 'Siva Sai Mandir',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 500,
            'size' => 150,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 11',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 4,
            'size' => 40,
            'floor' => 'First Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 12',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 4,
            'size' => 40,
            'floor' => 'First Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 13',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 4,
            'size' => 40,
            'floor' => 'First Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 14',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 4,
            'size' => 40,
            'floor' => 'First Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 15',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 4,
            'size' => 40,
            'floor' => 'First Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 21',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 8,
            'size' => 80,
            'floor' => 'Second Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 22',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 4,
            'size' => 40,
            'floor' => 'Second Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 23',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 8,
            'size' => 80,
            'floor' => 'Second Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 24',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 4,
            'size' => 40,
            'floor' => 'Second Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Room 25',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 4,
            'size' => 40,
            'floor' => 'Second Floor',
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 1,
            'building_id' => 1,
            'name' => 'Group Room',
            'is_for_events' => false,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 12,
            'size' => 100,
            'floor' => 'Third Floor',
            'description' => null,
        ]);


        DB::table('rooms')->insert([
            'location_id' => 2,
            'building_id' => null,
            'name' => 'Seminarraum',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 50,
            'size' => 65,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 2,
            'building_id' => null,
            'name' => 'Tempelraum',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 40,
            'size' => 65,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 2,
            'building_id' => null,
            'name' => 'Behandlungsraum',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 5,
            'size' => 12,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 3,
            'building_id' => null,
            'name' => 'Puja-Tempel',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 30,
            'size' => 25,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 3,
            'building_id' => null,
            'name' => 'Verlagsraum',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 20,
            'size' => 30,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 7,
            'building_id' => 3,
            'name' => 'Raum Himmel',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 30,
            'size' => 60,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 7,
            'building_id' => 3,
            'name' => 'Raum Erde',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 15,
            'size' => 38,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 7,
            'building_id' => 4,
            'name' => 'Lichtwerkstatt 1',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 35,
            'size' => 70,
            'floor' => null,
            'description' => null,
        ]);

        DB::table('rooms')->insert([
            'location_id' => 7,
            'building_id' => 4,
            'name' => 'Lichtwerkstatt 2',
            'is_for_events' => true,
            'is_blocked' => false,
            'reason_why_blocked' => '',
            'maximum_guests' => 60,
            'size' => 120,
            'floor' => null,
            'description' => null,
        ]);


    }
}
