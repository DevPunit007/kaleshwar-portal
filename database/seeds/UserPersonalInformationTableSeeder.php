<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPersonalInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_personal_information')->insert(
            [
                'id' => '1',
                'date_of_birth' => '1984-01-27',
                'time_of_birth' => '00:00',
                'place_of_birth' => 'India',
                'gender' => '1',
                'married' => '1',
                'name_of_spouse' => 'Kaleshwar Anupati',
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '2',
                'profession' => 'profession',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '2',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'India',
                'gender' => '1',
                'married' => '1',
                'name_of_spouse' => 'spuse',
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '1',
                'profession' => 'profession',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '3',
                'date_of_birth' => '1978-02-06',
                'time_of_birth' => '19:30',
                'place_of_birth' => 'Leipzig',
                'gender' => '0',
                'married' => '1',
                'name_of_spouse' => 'Regina',
                'name_of_father' => 'Klaus',
                'name_of_mother' => 'Larissa',
                'born_as_nth' => '2',
                'profession' => 'Administrator',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '4',
                'date_of_birth' => '1975-11-09',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'Leipzig',
                'gender' => '1',
                'married' => '1',
                'name_of_spouse' => 'Andre',
                'name_of_father' => 'Horst',
                'name_of_mother' => 'Lilli',
                'born_as_nth' => '1',
                'profession' => 'Manager',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '5',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'Leipzig',
                'gender' => '1',
                'married' => '0',
                'name_of_spouse' => null,
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '1',
                'profession' => 'Therapist',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '6',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'Augsburg',
                'gender' => '1',
                'married' => '1',
                'name_of_spouse' => 'Thomas',
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '2',
                'profession' => 'Teacher',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '7',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'Erfurt',
                'gender' => '1',
                'married' => '1',
                'name_of_spouse' => 'spuse',
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '1',
                'profession' => 'profession',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '8',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'Augsburg',
                'gender' => '1',
                'married' => '1',
                'name_of_spouse' => 'spuse',
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '1',
                'profession' => 'profession',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '9',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'München',
                'gender' => '1',
                'married' => '1',
                'name_of_spouse' => 'spuse',
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '1',
                'profession' => 'profession',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '10',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'Bad Tölz',
                'gender' => '0',
                'married' => '0',
                'name_of_spouse' => null,
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '1',
                'profession' => 'CFO',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '11',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'Leipzig',
                'gender' => '0',
                'married' => '0',
                'name_of_spouse' => null,
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '1',
                'profession' => 'programmer',
            ]
        );

        DB::table('user_personal_information')->insert(
            [
                'id' => '12',
                'date_of_birth' => '1980-01-01',
                'time_of_birth' => '10:00',
                'place_of_birth' => 'Wien',
                'gender' => '1',
                'married' => '0',
                'name_of_spouse' => null,
                'name_of_father' => 'father',
                'name_of_mother' => 'mother',
                'born_as_nth' => '1',
                'profession' => 'Teacher',
            ]
        );


    }
}
