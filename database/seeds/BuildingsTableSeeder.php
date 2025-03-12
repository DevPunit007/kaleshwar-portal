<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert([
            'id' => 1,
            'location_id' => 1,
            'name' => 'Southwest Building',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('buildings')->insert([
            'id' => 2,
            'location_id' => 1,
            'name' => 'Northwest Building',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

         DB::table('buildings')->insert([
            'id' => 3,
            'location_id' => 7,
            'name' => 'FindHaus',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('buildings')->insert([
            'id' => 4,
            'location_id' => 7,
            'name' => 'Lichtwerkstatt',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);


    }
}
