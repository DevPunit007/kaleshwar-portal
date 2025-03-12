<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert(
            ['name' => 'Bhajan']
        );
        DB::table('topics')->insert(
            ['name' => 'Five Elements']
        );
        DB::table('topics')->insert(
            ['name' => 'Kaleshwara Vaastu']
        );
        DB::table('topics')->insert(
            ['name' => 'Sri Chakra']
        );
        DB::table('topics')->insert(
            ['name' => 'Kala Chakra']
        );
        DB::table('topics')->insert(
            ['name' => 'Sai Shakti Healing']
        );
    }
}
