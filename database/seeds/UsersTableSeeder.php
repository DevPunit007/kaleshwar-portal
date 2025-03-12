<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'rule_id' => '4',
            'email' => 'admin@srikaleshwar.world',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Shilpa',
			'middle_name' => 'Kaleshwar',
			'last_name' => 'Anupati',
			'nickname' => null,
            'language_code' => 'en',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'rule_id' => '4',
            'email' => 'info@srikaleshwar.world',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Ashram',
			'middle_name' => null,
			'last_name' => 'Event-Team',
			'nickname' => null,
            'language_code' => 'en',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '3',
            'rule_id' => '3',
            'email' => 'thomas@stenzel.pro',
            'password' => bcrypt('kaleshwar99'),
			'first_name' => 'Thomas',
			'middle_name' => null,
			'last_name' => 'Stenzel',
			'nickname' => null,
            'language_code' => 'en',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '4',
            'rule_id' => '2',
            'email' => 'jana@student.com',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Jana',
            'middle_name' => null,
			'last_name' => 'Gaerditz',
			'nickname' => null,
            'language_code' => 'en',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '5',
            'rule_id' => '3',
            'email' => 'linda@teacher.com',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Linda',
			'middle_name' => null,
			'last_name' => 'Hermann',
			'nickname' => null,
            'language_code' => 'de',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '6',
            'rule_id' => '3',
            'email' => 'vivian@teacher.com',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Vivian',
			'middle_name' => null,
			'last_name' => 'Kneiss-Boegle',
			'nickname' => null,
            'language_code' => 'de',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '7',
            'rule_id' => '2',
            'email' => 'astrid@student.com',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Astrid',
			'middle_name' => null,
			'last_name' => 'Paul',
			'nickname' => null,
            'language_code' => 'de',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '8',
            'rule_id' => '2',
            'email' => 'karin@student.com',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Karin',
			'middle_name' => 'Maria',
			'last_name' => 'Wahle',
			'nickname' => null,
            'language_code' => 'de',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '9',
            'rule_id' => '2',
            'email' => 'christine@student.com',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Christine',
			'middle_name' => 'Pia',
			'last_name' => 'Röder',
			'nickname' => 'Mohini',
            'language_code' => 'de',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '10',
            'rule_id' => '1',
            'email' => 'sven@visitor.com',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Sven',
            'middle_name' => null,
			'last_name' => 'Angerer',
			'nickname' => null,
            'language_code' => 'de',
        	'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '11',
            'rule_id' => '4',
            'email' => 'admin@admin.de',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Admin Team',
			'middle_name' => null,
			'last_name' => 'Leipzig',
			'nickname' => null,
            'language_code' => 'de',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => '12',
            'rule_id' => '3',
            'email' => 'lucia@admin.de',
            'password' => bcrypt('kaleshwar99'),
            'first_name' => 'Lucia',
			'middle_name' => null,
			'last_name' => 'Boy',
			'nickname' => null,
            'language_code' => 'de',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    }
}
