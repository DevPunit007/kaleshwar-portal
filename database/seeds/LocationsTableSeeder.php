<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'id' => 1,
            'geodata' => '14.078301, 77.594306',
            'creator_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('locations')->insert([
            'id' => 2,
            'geodata' => '51.330460, 12.337366',
            'creator_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('locations')->insert([
            'id' => 3,
            'geodata' => '51.280523, 12.288165',
            'creator_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('locations')->insert([
            'id' => 4,
            'geodata' => '50.018244, 11.206096',
            'creator_id' => 6,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('locations')->insert([
            'id' => 5,
            'geodata' => '48.364097, 10.903592',
            'creator_id' => 6,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('locations')->insert([
            'id' => 6,
            'geodata' => '',
            'creator_id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('locations')->insert([
            'id' => 7,
            'geodata' => '51.046634, 7.418285',
            'creator_id' => 6,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    }
}
