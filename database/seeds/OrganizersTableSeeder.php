<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('organizers')->insert([
            'id' => '1',
            'organizer_name' => 'Sri Kaleshwar Ashram',
            'type' => 'group',
            'token' => 'J6S6t5bixuRy7xDjXYfO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('organizers')->insert([
            'id' => '2',
            'organizer_name' => 'Sai Retreat Kleinziegenfeld',
            'type' => 'group',
            'token' => 'yrLYOitbuK27t0njcg9Y',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('organizers')->insert([
            'id' => '3',
            'organizer_name' => 'Vivian Kneiss-Boegle',
            'type' => 'teacher',
            'token' => 'YyGEuucWOjjO4RrfA5NQ',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('organizers')->insert([
            'id' => '4',
            'organizer_name' => 'Sai Family Leipzig',
            'type' => 'group',
            'token' => 'MbRTvpZchQ5pfGc1tALW',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('organizers')->insert([
            'id' => '5',
            'organizer_name' => 'Linda Hermann',
            'type' => 'teacher',
            'token' => 'xhOOsZ00CRFdGNua41MM',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
