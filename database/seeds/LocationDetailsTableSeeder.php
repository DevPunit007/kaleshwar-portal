<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location_details')->insert([
            'location_id' => 1,
            'name' => 'Sri Kaleshwar Ashram',
            'address_street' => 'Sri Kaleshwar Ashram',
            'address_no' => null,
            'address_supplements' => 'Shiva Sai Mandir',
            'city' => 'Penukonda',
            'state' => 'Andhra Pradesh',
            'zip' => '515110',
            'country' => 'India',
            'language' => 'en'
        ]);

        DB::table('location_details')->insert([
            'location_id' => 2,
            'name' => 'Shirdi Sai Center',
            'address_street' => 'Zschochersche Strasse',
            'address_no' => '38',
            'address_supplements' => null,
            'city' => 'Leipzig',
            'state' => 'Sachsen',
            'zip' => '04229',
            'country' => 'Deutschland',
            'language' => 'de'
        ]);

        DB::table('location_details')->insert([
            'location_id' => 3,
            'name' => 'Sri Kaleshwar Publishing',
            'address_street' => 'Wildschweinpfad',
            'address_no' => '45',
            'address_supplements' => null,
            'city' => 'Leipzig',
            'state' => 'Sachsen',
            'zip' => '04249',
            'country' => 'Deutschland',
            'language' => 'de'
        ]);

        DB::table('location_details')->insert([
            'location_id' => 4,
            'name' => 'Sai Retreat Kleinziegenfeld',
            'address_street' => 'Schlossweg',
            'address_no' => '16',
            'address_supplements' => 'Schlosscamping',
            'city' => 'Leipzig',
            'state' => 'Bayern',
            'zip' => '96260',
            'country' => 'Deutschland',
            'language' => 'de'
        ]);

        DB::table('location_details')->insert([
            'location_id' => 5,
            'name' => 'Seminar- und Heilzentrum',
            'address_street' => 'Beim Schnarrbrunnen',
            'address_no' => '15',
            'address_supplements' => null,
            'city' => 'Augsburg',
            'state' => 'Bayern',
            'zip' => '86150',
            'country' => 'Deutschland',
            'language' => 'de'
        ]);

        DB::table('location_details')->insert([
            'location_id' => 6,
            'name' => 'Sai Shakti Center',
            'address_street' => 'Gutshofweg',
            'address_no' => '4',
            'address_supplements' => null,
            'city' => 'Hohenwarth',
            'state' => 'Bayern',
            'zip' => '93480',
            'country' => 'Deutschland',
            'language' => 'de'
        ]);

        DB::table('location_details')->insert([
            'location_id' => 7,
            'name' => 'Findhof Opitz GbR',
            'address_street' => 'An der Sülz',
            'address_no' => '61',
            'address_supplements' => null,
            'city' => 'Lindlar',
            'state' => 'Nordrhein-Westfalen',
            'zip' => '51789',
            'country' => 'Deutschland',
            'language' => 'de'
        ]);
    }
}
