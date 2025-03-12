<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_sections')->insert(
            [
                'id' => '1', // full program fee
                'event_id' => '1',
                'room_id' => '1',
                'section_tutor_id' => null,
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '540',
                'price_euro' => '500'

            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '2', // Special program fee for IE
                'event_id' => '1',
                'room_id' => '1',
                'section_tutor_id' => null,
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '144',
                'price_euro' => '120'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '3', // long distance puja fee
                'event_id' => '4',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => true,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '45',
                'price_euro' => '40'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '4', // video streaming fee
                'event_id' => '1',
                'room_id' => null,
                'section_tutor_id' => '12',
                'has_own_date' => true,
                'start_date' => '2019-12-26',
                'end_date' => '2019-12-26',
                'start_time' => '16:00',
                'end_time' => '19:00',
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '45',
                'price_euro' => '40'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '5', // visiting ashram hat keinen Preis muss aber gebucht werden
                'event_id' => '2',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => null,
                'price_euro' => null
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '6', // Full price_usd SR im Ashram
                'event_id' => '3',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '540',
                'price_euro' => '500'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '7', // video streaming fee
                'event_id' => '3',
                'room_id' => null,
                'section_tutor_id' => '6',
                'has_own_date' => true,
                'start_date' => '2020-02-20',
                'end_date' => '2020-02-20',
                'start_time' => '16:00',
                'end_time' => '19:00',
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '45',
                'price_euro' => '40'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '8', // day 1 at Kleinziegenfeld
                'event_id' => '7',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => true,
                'start_date' => '2020-02-19',
                'end_date' => '2020-02-19',
                'start_time' => '10:00',
                'end_time' => '19:00',
                'is_visible' => true,
                'is_topic' => true,
                'is_bookable' => false,
                'price_usd' => null
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '9', // day 2 at Kleinziegenfeld
                'event_id' => '7',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => true,
                'start_date' => '2020-02-20',
                'end_date' => '2020-02-20',
                'start_time' => '10:00',
                'end_time' => '19:00',
                'is_visible' => true,
                'is_topic' => true,
                'is_bookable' => false,
                'price_usd' => null
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '10', // day 3 at Kleinziegenfeld
                'event_id' => '7',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => true,
                'start_date' => '2020-02-21',
                'end_date' => '2020-02-21',
                'start_time' => '10:00',
                'end_time' => '19:00',
                'is_visible' => true,
                'is_topic' => true,
                'is_bookable' => false,
                'price_usd' => null
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '11', // Full price_usd Mahasamadhi Ashram
                'event_id' => '4',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '540',
                'price_euro' => '500'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '12', // Free entrance for Bhajans
                'event_id' => '5',
                'room_id' => '14',
                'section_tutor_id' => '4',
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => null,
                'price_euro' => null
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '13', // Free entrance for Satsang Vivian
                'event_id' => '6',
                'room_id' => null,
                'section_tutor_id' => '6',
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => null,
                'price_euro' => null
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '14', // Program in Kleinziegenfeld
                'event_id' => '7',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => null,
                'price_euro' => '108'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '15', // Course fee for Lindas Course
                'event_id' => '8',
                'room_id' => '13',
                'section_tutor_id' => '5',
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => null,
                'price_euro' => '100'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '16', // Special program fee for IE
                'event_id' => '3',
                'room_id' => '1',
                'section_tutor_id' => null,
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '144',
                'price_euro' => '120'
            ]
        );

        DB::table('event_sections')->insert(
            [
                'id' => '17', // puja dakshina
                'event_id' => '9',
                'room_id' => null,
                'section_tutor_id' => null,
                'has_own_date' => false,
                'start_date' => null,
                'end_date' => null,
                'start_time' => null,
                'end_time' => null,
                'is_visible' => true,
                'is_topic' => false,
                'is_bookable' => true,
                'price_usd' => '21',
                'price_euro' => '18'
            ]
        );

    }
}
