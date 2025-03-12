<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_rules')->insert([ 'name' => 'Visitor' ]);
        DB::table('user_rules')->insert([ 'name' => 'Student' ]);
        DB::table('user_rules')->insert([ 'name' => 'Teacher' ]);
        DB::table('user_rules')->insert([ 'name' => 'Superadmin' ]);
        DB::table('user_rules')->insert([ 'name' => 'Dev_Team' ]);
    }
}
