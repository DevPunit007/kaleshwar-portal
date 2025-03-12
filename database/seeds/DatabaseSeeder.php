<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRulesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OrganizersTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(LocationDetailsTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(UserOrganizerRelationsTableSeeder::class);
        $this->call(EventCategoriesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EventDetailsTableSeeder::class);
        $this->call(UserContactInformationTableSeeder::class);
        $this->call(UserPersonalInformationTableSeeder::class);
        $this->call(UserSpiritualHistoriesTableSeeder::class);
        $this->call(UserChildrenTableSeeder::class);
        $this->call(UserFilesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(EventSectionsTableSeeder::class);
        $this->call(EventSectionDetailsTableSeeder::class);
        $this->call(BookingTableSeeder::class);
        $this->call(BookingDetailsTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(PaymentAccountsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);

    }
}
