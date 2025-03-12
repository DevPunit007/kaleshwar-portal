<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_categories')->insert(
            [
                'id' => '1',
                'event_category_name' => 'Satsang'
            ]
        );
        DB::table('event_categories')->insert(
            [
                'id' => '2',
                'event_category_name' => 'Course'
            ]
        );
        DB::table('event_categories')->insert(
            [
                'id' => '3',
                'event_category_name' => 'Seminar'
            ]
        );
        DB::table('event_categories')->insert(
            [
                'id' => '4',
                'event_category_name' => 'Program'
            ]
        );
        DB::table('event_categories')->insert(
            [
                'id' => '5',
                'event_category_name' => 'Bhajan'
            ]
        );
        DB::table('event_categories')->insert(
            [
                'id' => '6',
                'event_category_name' => 'Charity'
            ]
        );
        DB::table('event_categories')->insert(
            [
                'id' => '7',
                'event_category_name' => 'Visits'
            ]
        );
        DB::table('event_categories')->insert(
            [
                'id' => '8',
                'event_category_name' => 'Fire puja'
            ]
        );
        DB::table('event_categories')->insert(
            [
                'id' => '9',
                'event_category_name' => 'Meditation'
            ]
        );
    }
}
