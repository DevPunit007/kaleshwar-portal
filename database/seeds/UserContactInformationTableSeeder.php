<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserContactInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_contact_information')->insert(
            [
                'id' => '1',
                'address_street' => 'Shiva sai mandir',
                'address_no' => null,
                'address_supplements' => 'Near Gagan Mahal',
                'zip' => '515110',
                'city' => 'Penukonda',
                'state' => 'Andhra Pradesh',
                'country' => 'in'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '2',
                'address_street' => 'Shiva sai mandir',
                'address_no' => null,
                'address_supplements' => null,
                'zip' => '515110',
                'city' => 'Penukonda',
                'state' => 'Andhra Pradesh',
                'country' => 'in'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '3',
                'address_street' => 'Wildschweinpfad',
                'address_no' => '45',
                'address_supplements' => 'Knautkleeberg',
                'zip' => '04249',
                'city' => 'Leipzig',
                'state' => 'Saxony',
                'country' => 'de'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '4',
                'address_street' => 'Dieskaustr.',
                'address_no' => '427',
                'address_supplements' => null,
                'zip' => '04249',
                'city' => 'Leipzig',
                'state' => 'Saxony',
                'country' => 'de'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '5',
                'address_street' => 'Seumestr.',
                'address_no' => '137b',
                'address_supplements' => null,
                'zip' => '04249',
                'city' => 'Leipzig',
                'state' => 'Saxony',
                'country' => 'de'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '6',
                'address_street' => 'Ottmarshauser Str.',
                'address_no' => '26',
                'address_supplements' => null,
                'zip' => '86356',
                'city' => 'Neusaess',
                'state' => 'Bavaria',
                'country' => 'de'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '7',
                'address_street' => 'Weberstr.',
                'address_no' => '60',
                'address_supplements' => null,
                'zip' => '07426',
                'city' => 'Königsee',
                'state' => 'Thuringia',
                'country' => 'de'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '8',
                'address_street' => 'Herrenbach Str.',
                'address_no' => '31',
                'address_supplements' => null,
                'zip' => '86161',
                'city' => 'London',
                'state' => 'London',
                'country' => 'gb'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '9',
                'address_street' => 'Hochfirststr.',
                'address_no' => '9',
                'address_supplements' => null,
                'zip' => '79115',
                'city' => 'Freiburg',
                'state' => 'Bavaria',
                'country' => 'de'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '10',
                'address_street' => 'Herzogstandstr.',
                'address_no' => '2',
                'address_supplements' => null,
                'zip' => '82327',
                'city' => 'Tutzing',
                'state' => 'Bavaria',
                'country' => 'de'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '11',
                'address_street' => 'Hainstraße',
                'address_no' => '1-3',
                'address_supplements' => '',
                'zip' => '04109',
                'city' => 'Leipzig',
                'state' => 'Saxony',
                'country' => 'de'
            ]
        );

        DB::table('user_contact_information')->insert(
            [
                'id' => '12',
                'address_street' => 'street',
                'address_no' => '1',
                'address_supplements' => '',
                'zip' => '80909',
                'city' => 'City',
                'state' => 'Bavaria',
                'country' => 'de'
            ]
        );

    }
}
