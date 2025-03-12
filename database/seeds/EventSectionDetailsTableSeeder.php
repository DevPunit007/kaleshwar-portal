<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSectionDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '1',
                'title' => 'Programm fee',
                'description' => '',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '2',
                'title' => 'Special fee',
                'description' => 'for those who attend the IE program in 2011',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '2',
                'title' => 'Special fee',
                'description' => 'for those who attend the IE program in 2011',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '2',
                'title' => 'Special fee',
                'description' => 'for those who attend the IE program in 2011',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '2',
                'title' => 'Special fee',
                'description' => 'for those who attend the IE program in 2011',
                'language' => 'en'
            ]
        );
        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '3',
                'title' => 'Single package price',
                'description' => 'Long distance fire puja registration',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '4',
                'title' => 'Single package price',
                'description' => 'Live Satsang registration',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '5',
                'title' => 'Visitor fee',
                'description' => 'Visitors pay the Daily rate of 1500 Rps. This includes accommodations and three Indian Vegetarian meals per day',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '6',
                'title' => 'Programm fee',
                'description' => 'Regular fee',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '7',
                'title' => 'Single package price',
                'description' => 'Video Streaming registration',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '8',
                'title' => 'Program SR 2020 - Day 1',
                'description' => 'We have meditation.',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '9',
                'title' => 'Program SR 2020 - Day 2',
                'description' => 'We have seminars.',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '10',
                'title' => 'Program SR 2020 - Day 3',
                'description' => 'We have a fire puja.',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '11',
                'title' => 'Programm fee',
                'description' => '',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '11',
                'title' => 'Programm Gebühr',
                'description' => '',
                'language' => 'de'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '12',
                'title' => 'Free Entrance',
                'description' => '',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '12',
                'title' => 'Freier Eintritt',
                'description' => '',
                'language' => 'de'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '13',
                'title' => 'Freier Eintritt',
                'description' => '',
                'language' => 'de'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '14',
                'title' => 'Programm Gebühr',
                'description' => '',
                'language' => 'de'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '15',
                'title' => 'Kurs-Gebühr',
                'description' => '',
                'language' => 'de'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '16',
                'title' => 'Special fee',
                'description' => 'for those who attend the IE program in 2011',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '17',
                'title' => 'Dakshina',
                'description' => 'please give a donation',
                'language' => 'en'
            ]
        );

        DB::table('event_section_details')->insert(
            [
                'event_section_id' => '17',
                'title' => 'Spende',
                'description' => 'bitte gib einen Energieausgleich.',
                'language' => 'de'
            ]
        );


    }
}
