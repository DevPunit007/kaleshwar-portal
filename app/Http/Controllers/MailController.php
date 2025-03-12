<?php

namespace App\Http\Controllers;
use App\Booking;
use App\NewsletterLog;
use App\NotificationLog;
use App\User;
use App\Event;
use App\Mail\NLforGroup;
use App\Mail\NLforEvent;
use App\Mail\NLforTeacher;
use App\Mail\AllEvents;
use App\Organizer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  int  $emailAddress
     * @return
     */
    public function ajaxShipAllEventsMail($emailAddress)
    {
        $events = Event::with('eventDetails')->with('locationDetails')->get();
        $events = $events->where('organizer_id', '1'); // Im Newsletter nur Events vom Ashram zum Vorführen
        $allEventsMail = new AllEvents($events);

        //  Mail::to($request->user())->send(new EventBooked($event));
        Mail::to($emailAddress)->bcc('thomas@stenzel.pro')->send($allEventsMail);
        return('success');
    }

    public function sendMessageToGroup()
    {
        //$organizer = Organizer::where('id', '101')->with('users')->first();
        $organizer = Organizer::where('id', '101')->with('users')->first();


        foreach($organizer->users as $user) {
            if($user->status !== 3) {
                try {
                    $NLforIEmail = new NLforGroup($user);
                    Mail::to($user->email)->send($NLforIEmail);
                    NewsletterLog::create([
                        'user_id' => $user->id,
                        'newsletter_id' => '1',
                        'result' => 'NL to IE attendee succesfully sent'
                    ]);
                }
                catch(\Exception $e){
                    NewsletterLog::create([
                        'user_id' => $user->id,
                        'newsletter_id' => '1',
                        'result' => $e
                    ]);
                }
            }
            //sleep(1);
        }
        return('success');
    }

    public function sendMessageToEvent()
    {
        $event = Event::where('id', '238')->with('eventSections')->first();
        $eventSections = $event->eventSections->pluck('id');
        $bookings = Booking::whereIn('event_section_id', $eventSections)->whereNotIn('status', [3])->with('user')->get();
        //dd($bookings);

        foreach($bookings as $booking) {
            if($booking->user->status !== 3) {
                try {
                    $NLforEvent = new NLforEvent($booking->user);
                    Mail::to($booking->user->email)->send($NLforEvent);
                    NewsletterLog::create([
                        'user_id' => $booking->user->id,
                        'newsletter_id' => '3',
                        'result' => 'Easter message succesfully sent'
                    ]);
                }
                catch(\Exception $e){
                    NewsletterLog::create([
                        'user_id' => $booking->user->id,
                        'newsletter_id' => '4',
                        'result' => $e
                    ]);
                }
            }
            //sleep(1);
        }
        return('success');
    }

    public function sendMessageToUsers()
    {
        $bookings = Booking::where('id', '>', '44999')->whereNotIn('status', [3])->with('user')->get();
        $bookings_unique_user = $bookings->unique('user_id');

        foreach($bookings_unique_user as $booking) {
            if($booking->user->status !== 3) {
                try {
                    $NLforUser = new NLforGroup($booking->user);
                    Mail::to($booking->user->email)->send($NLforUser);
                    NewsletterLog::create([
                        'user_id' => $booking->user->id,
                        'newsletter_id' => '5',
                        'result' => 'Feedback message succesfully sent'
                    ]);
                }
                catch(\Exception $e){
                    NewsletterLog::create([
                        'user_id' => $booking->user->id,
                        'newsletter_id' => '5',
                        'result' => $e
                    ]);
                }
            }
            //sleep(1);
        }
        return('success');
    }

    public function sendMessageToTeacher($locale, $id)
    {
        $organizer = Organizer::find($id);
        //dd($organizer);
        if($organizer->status < 3) {
            if(!empty($organizer->organizer_email)) {
                $email_for_message = $organizer->organizer_email;
            } else {
                $email_for_message = $organizer->admin->email;
            }
            try {
                $NLforTeacher = new NLforTeacher($organizer->admin);
                Mail::to($email_for_message)->send($NLforTeacher);
                NotificationLog::create([
                    'reference_type' => 'App\Organizer',
                    'reference_id' => $organizer->id,
                    'reason' => 'Set up the teacher profile',
                    'result' => 'success'
                ]);
            }
            catch(\Exception $e){
                NotificationLog::create([
                    'reference_type' => 'App\Organizer',
                    'reference_id' => $organizer->id,
                    'reason' => 'Set up the teacher profile',
                    'result' => $e
                ]);
            }
        }

        return redirect()->back();
    }
}

