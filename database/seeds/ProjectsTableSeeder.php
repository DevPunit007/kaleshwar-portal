<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert(
            [
                'id' => '1',
                'list_name' => 'Medical_Clinic',
                'organizer_id' => '2',
                'project_contact_person_id' => '2',
                'location_id' => '1',
                'is_visible' => '1'
            ]
        );
    }
}
