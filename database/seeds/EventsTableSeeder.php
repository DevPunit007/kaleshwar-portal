<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert(
            [
                'id' => '1',
                'list_name' => 'Christmas',
                'event_category_id' => '4',
                'organizer_id' => '1',
                'event_contact_person_id' => '2',
                'location_id' => '1',
                'is_visible' => '1',
                'has_date' => '1',
                'start_date' => \Carbon\Carbon::today()->format('Y').'-12-22',
                'end_date' => \Carbon\Carbon::today()->format('Y').'-12-29',
                'start_time' => '00:00',
                'end_time' => '00:00',
                'use_booking' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('events')->insert(
            [
                'id' => '2',
                'list_name' => 'Visiting_Ashram',
                'event_category_id' => '7',
                'organizer_id' => '1',
                'event_contact_person_id' => '2',
                'location_id' => '1',
                'is_visible' => '1',
                'has_date' => '0',
                'start_date' => \Carbon\Carbon::today()->format('Y').'-01-01',
                'end_date' => \Carbon\Carbon::today()->format('Y').'-12-31',
                'start_time' => '00:00',
                'end_time' => '00:00',
                'use_booking' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('events')->insert(
            [
                'id' => '3',
                'list_name' => 'Program_Ashram',
                'event_category_id' => '4',
                'organizer_id' => '1',
                'event_contact_person_id' => '2',
                'location_id' => '1',
                'is_visible' => '1',
                'has_date' => '1',
                'start_date' => \Carbon\Carbon::today()->addMonth(2)->format('Y-m').'-18',
                'end_date' => \Carbon\Carbon::today()->addMonth(2)->format('Y-m').'-22',
                'start_time' => '00:00',
                'end_time' => '00:00',
                'use_booking' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('events')->insert(
            [
                'id' => '4',
                'list_name' => 'Mahasamadhi',
                'event_category_id' => '4',
                'organizer_id' => '1',
                'event_contact_person_id' => '2',
                'location_id' => '1',
                'is_visible' => '1',
                'has_date' => '1',
                'start_date' => \Carbon\Carbon::today()->format('Y').'-03-13',
                'end_date' => \Carbon\Carbon::today()->format('Y').'-03-15',
                'start_time' => '00:00',
                'end_time' => '00:00',
                'use_booking' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('events')->insert(
            [
                'id' => '5',
                'list_name' => 'Bhajans',
                'event_category_id' => '5',
                'organizer_id' => '4',
                'event_contact_person_id' => '4',
                'location_id' => '2',
                'is_visible' => '1',
                'has_date' => '1',
                'start_date' => \Carbon\Carbon::today()->addMonth(2)->format('Y-m').'-05',
                'end_date' => \Carbon\Carbon::today()->addMonth(2)->format('Y-m').'-05',
                'start_time' => '16:00',
                'end_time' => '20:00',
                'use_booking' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('events')->insert(
            [
                'id' => '6',
                'list_name' => 'Satsang_Vivian',
                'event_category_id' => '1',
                'organizer_id' => '3',
                'event_contact_person_id' => '8',
                'location_id' => '5',
                'is_visible' => '1',
                'has_date' => '1',
                'start_date' => \Carbon\Carbon::today()->addMonth(4)->format('Y-m').'-07',
                'end_date' => \Carbon\Carbon::today()->addMonth(4)->format('Y-m').'-07',
                'start_time' => '10:00',
                'end_time' => '18:00',
                'use_booking' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('events')->insert(
            [
                'id' => '7',
                'list_name' => 'Special_program',
                'event_category_id' => '4',
                'organizer_id' => '2',
                'event_contact_person_id' => '2',
                'location_id' => '4',
                'is_visible' => '1',
                'has_date' => '1',
                'start_date' => \Carbon\Carbon::today()->addMonth(2)->format('Y-m').'-13',
                'end_date' => \Carbon\Carbon::today()->addMonth(2)->format('Y-m').'-15',
                'start_time' => '00:00',
                'end_time' => '00:00',
                'use_booking' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('events')->insert(
            [
                'id' => '8',
                'list_name' => 'Linda_Seminar',
                'event_category_id' => '3',
                'organizer_id' => '5',
                'event_contact_person_id' => '5',
                'location_id' => '2',
                'is_visible' => '1',
                'has_date' => '1',
                'start_date' => \Carbon\Carbon::today()->addMonth(5)->format('Y-m').'-11',
                'end_date' => \Carbon\Carbon::today()->addMonth(5)->format('Y-m').'-12',
                'start_time' => '10:00',
                'end_time' => '19:00',
                'use_booking' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('events')->insert(
            [
                'id' => '9',
                'list_name' => 'FM fire puja',
                'event_category_id' => '8',
                'organizer_id' => '1',
                'event_contact_person_id' => '2',
                'location_id' => '1',
                'is_visible' => '1',
                'has_date' => '1',
                'start_date' => \Carbon\Carbon::today()->addMonth(3)->format('Y-m').'-12',
                'end_date' => \Carbon\Carbon::today()->addMonth(3)->format('Y-m').'-12',
                'start_time' => '00:00',
                'end_time' => '00:00',
                'use_booking' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
