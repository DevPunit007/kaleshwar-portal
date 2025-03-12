<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserOrganizerRelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('user_organizer_relations')->insert([
            'user_id' => '1',
            'organizer_id' => '1',
            'role' => 'admin',
        ]);

        DB::table('user_organizer_relations')->insert([
            'user_id' => '2',
            'organizer_id' => '1',
            'role' => 'editor',
        ]);
        
        DB::table('user_organizer_relations')->insert([
            'user_id' => '3',
            'organizer_id' => '2',
            'role' => 'editor',
        ]);
        
        DB::table('user_organizer_relations')->insert([
            'user_id' => '3',
            'organizer_id' => '4',
            'role' => 'admin',
        ]);

        DB::table('user_organizer_relations')->insert([
            'user_id' => '4',
            'organizer_id' => '4',
            'role' => 'editor',
        ]);

        DB::table('user_organizer_relations')->insert([
            'user_id' => '5',
            'organizer_id' => '4',
            'role' => 'member',
        ]);
        
        DB::table('user_organizer_relations')->insert([
            'user_id' => '5',
            'organizer_id' => '5',
            'role' => 'admin',
        ]);
        
        DB::table('user_organizer_relations')->insert([
            'user_id' => '6',
            'organizer_id' => '2',
            'role' => 'admin',
        ]);

        DB::table('user_organizer_relations')->insert([
            'user_id' => '6',
            'organizer_id' => '3',
            'role' => 'admin',
        ]);

        DB::table('user_organizer_relations')->insert([
            'user_id' => '7',
            'organizer_id' => '2',
            'role' => 'editor',
        ]);

        DB::table('user_organizer_relations')->insert([
            'user_id' => '7',
            'organizer_id' => '3',
            'role' => 'editor',
        ]);

        DB::table('user_organizer_relations')->insert([
            'user_id' => '8',
            'organizer_id' => '3',
            'role' => 'member',
        ]);

        DB::table('user_organizer_relations')->insert([
            'user_id' => '9',
            'organizer_id' => '2',
            'role' => 'member',
        ]);



    }
}
