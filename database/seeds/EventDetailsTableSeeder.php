<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_details')->insert(
            [
                'event_id' => '1',
                'title' => 'Christmas program',
                'introduction' => 'During the Christmas days we will have meditation groups in the Jesus temple and learn deeper knowledge about the Jesus.',
                'description' => 'The progam is in a very peaceful time around Christmas.',
                'before_booking' => 'Please register through the next form for the special program ',
                'intro_booking' => 'Introduction text for the booking form',
                'closing_booking' => 'Closing text with some late details before the booking will finish',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '1',
                'title' => 'Weihnachtsprogram',
                'before_booking' => 'Bitte vor der Buchung ein Konto anlegen.',
                'introduction' => 'Es wird eine schönes Programm.',
                'description' => 'Das Program findet zu einer sehr ruhigen Zeit zu Weihnachten statt.',
                'intro_booking' => 'Einleitungstext für das Buchungsformular',
                'closing_booking' => 'Zum Abschluss noch ein paar Details bevor die Buchung abgeschlossen wird.',
                'language' => 'de',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '2',
                'title' => 'Visiting The Ashram',
                'before_booking' => 'Register for your stay to meditate or to study',
                'introduction' => 'If you want to visit the Ashram register first.',
                'description' => 'Additional information about the Visits.',
                'intro_booking' => 'Please answer the following questions and add some details about your journey.',
                'closing_booking' => 'After you register for the visit you get a lot of information about the Ashram in your download section in your user account.',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '3',
                'title' => 'Program at the Ashram',
                'before_booking' => 'Please register through the next form for the special program at the Ashram',
                'introduction' => 'If you want to book the Ashram register first.',
                'description' => '<p>A powerful program will celebrate in Ashram with all of you.</p>',
                'intro_booking' => 'Please answer the following questions and add some details about your journey.',
                'closing_booking' => 'After you register for the visit you get a lot of information about the Ashram in your download section in your user account.',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '4',
                'title' => 'Sri Kaleshwar Mahasamadhi 2020',
                'before_booking' => 'Register for the special program at Swamis samadhi',
                'introduction' => 'If you want to visit the Ashram register first.',
                'description' => 'Additional information about the Visits.',
                'intro_booking' => 'Please answer the following questions and add some details about your journey.',
                'closing_booking' => 'After you register for the visit you get a lot of information about the Ashram in your download section in your user account.',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '5',
                'title' => 'Bhajan evening',
                'before_booking' => 'Register for the bhajan program',
                'introduction' => 'Let us sing for one evening Indian traditional songs with Shiva Sai Mandir Music',
                'description' => '<p>We start at 4pm with the Bhajans and have a break for snacks around 6pm.</p><p>Please bring some snacks with you.</p>',
                'intro_booking' => 'There is no booking only send an email to the organizer that we can plan the event in a better way.',
                'closing_booking' => 'Click at the button and send a short email that we know that you like to come to the evening.',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '5',
                'title' => 'Bhajan Abend',
                'before_booking' => '',
                'introduction' => 'Lasst uns gemeinsam einen Abend Indische traditionelle Lieder mit Shiva Sai Mandir Musik singen',
                'description' => '<p>Wir beginnen 16 Uhr mit den Bhajans und haben eine kleine Pause für Snacks gegen 18 Uhr.</p><p>Bitte bring eigene Snacks mit, die du magst.</p>',
                'intro_booking' => 'Es gibt keine Buchung, wenn du kommen möchtest schick einfach eine E-Mail an uns, damit wir den Abend vorbreiten können.',
                'closing_booking' => 'Klick einfach auf den Button und sende die E-Mail an uns ab. Vielen Dank.',
                'language' => 'de',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '6',
                'title' => 'Satsang about Kala Chakra',
                'before_booking' => 'Register now for that special program',
                'introduction' => 'Everybody is invited to have an exchange of how we practise with the yantra.',
                'description' => 'Additional information about the Satsang.',
                'intro_booking' => 'Please answer the following question and send a message about your attendee.',
                'closing_booking' => 'After you send your booking email you will get more details about the satsang.',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '7',
                'title' => 'Special program in Kleinziegenfeld',
                'before_booking' => 'Register now for that special program',
                'introduction' => 'We start the spring with the first program at that peaceful and natural place.',
                'description' => 'Additional information about the program.',
                'intro_booking' => 'Please answer the following questions and add some details about your diet.',
                'closing_booking' => 'After you register you will get more information about the program.',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '8',
                'title' => 'Gewaltfreie Kommunikation',
                'before_booking' => 'Jetzt buchen...',
                'introduction' => 'Lerne eine neue Art der Kommunikation kennen. Erfahre was es bedeutet in Gesprächen bei dir zu bleiben.',
                'description' => 'Der Kurs ist am Wochenende und endet am Sonntag um 19 Uhr.',
                'intro_booking' => 'Wir haben nur eine Frage zu deiner Vorkenntnis zu dem Thema.',
                'closing_booking' => 'Nach der Buchung erhälst du Informationen zur Vorkasse, damit du den Frühbucher-Rabatt nutzen kannst.',
                'language' => 'de',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '9',
                'title' => 'Full moon fire puja',
                'before_booking' => 'Register for the special puja at Swamis dhuni',
                'introduction' => 'Powerful Indian ceremony.',
                'description' => 'Additional information about the puja.',
                'intro_booking' => 'Please answer the following questions and add some details about your journey.',
                'closing_booking' => 'After you register for the visit you get a lot of information about the Ashram in your download section in your user account.',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        DB::table('event_details')->insert(
            [
                'event_id' => '9',
                'title' => 'Vollmond Feuerpuja',
                'before_booking' => 'Du benötigst einen Account um das Event zu buchen. Bitte anlegen oder einloggen.',
                'introduction' => 'Kraftvolle indische Zerermonie.',
                'description' => 'Zusätzliche Informationen zu der Puja.',
                'intro_booking' => 'Bitte hier den Anweisungen folgen.',
                'closing_booking' => 'Nach der Buchung erhälst du eine Bestätigung per E-Mail mit weiteren Anweisungen.',
                'language' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
