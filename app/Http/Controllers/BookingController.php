<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingDetail;
use App\Comment;
use App\Event;
use App\EventDetail;
use App\EventSection;
use App\Mail\DevObserver;
use App\Mail\BookingRegistration;
use App\Mail\BookingSuccess;
use App\Mail\BookingAcceptance;
use App\Mail\BookingPaymentConfirmation;
use App\Mail\BookingPaymentReminder;
use App\User;
use App\UserAshramData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function showList()
    {
        $bookings = Booking::where('id','>', '44999')->with('user', 'user.contactInformation', 'user.ashramData', 'event', 'event.eventDetails', 'eventSection', 'eventSectionDetail')->get();

        return view('pages.booking.list')->with([
            'bookings' => $bookings,
            'list_status' => 'all'
            ]);
    }

    public function showListCurrent()
    {
        $bookings = Booking::where('created_at','>', Carbon::today()->subMonth(2)->format('Y-m-d'))->with('user', 'user.contactInformation', 'user.ashramData', 'event', 'event.eventDetails', 'event.eventSectionDetails')->get();

        return view('pages.booking.list')->with([
            'bookings' => $bookings,
            'list_status' => 'current'
        ]);
    }

    public function showListOpen()
    {
        $bookings = Booking::where('id','>', '44999')->whereIn('status', ['1', '2', '4'])->with('user', 'user.contactInformation', 'user.ashramData', 'event', 'event.eventDetails', 'event.eventSectionDetails')->get();

        return view('pages.booking.list')->with([
            'bookings' => $bookings,
            'list_status' => 'open'
        ]);
    }

    public function showListUser()
    {
        $user = auth()->user();
        $bookings = Booking::where('user_id', auth()->user()['id'])->with('user', 'event', 'event.eventDetails')->get()->sortByDesc('event.start_date');

        return view('pages.booking.list-user')->with([
            'user' => $user,
            'bookings' => $bookings
        ]);
    }

    /**
     * 	Show form to edit booking
     */
    public function showForEdit($locale, $id)
    {
        $booking = Booking::whereId($id)->with('comments')->first();
        $eventSection = EventSection::where('id', $booking->event_section_id)->first();
        $event = Event::where('id', $eventSection->event_id)->first();
        $eventDetail = EventDetail::where('event_id', $booking->event->id)->first();
        $user = User::where('id', $booking->user_id)->first();

        return view('pages.booking.edit-booking')->with([
            'booking' => $booking,
            'eventSection' => $eventSection,
            'event' => $event,
            'eventDetail' => $eventDetail,
            'user' => $user
        ]);
    }

    /**
     * 	Show for user the form to edit booking
     */
    public function showForUserEdit($locale, $id)
    {
        $booking = Booking::whereId($id)->where('user_id', auth()->user()->id)->with('comments')->first();
        if($booking) {
            $eventSection = EventSection::where('id', $booking->event_section_id)->first();
            $event = Event::where('id', $eventSection->event_id)->first();
            $eventDetail = EventDetail::where('event_id', $booking->event->id)->first();
            $user = User::where('id', $booking->user_id)->first();

            return view('pages.booking.edit-user')->with([
                'booking' => $booking,
                'eventSection' => $eventSection,
                'event' => $event,
                'eventDetail' => $eventDetail,
                'user' => $user
            ]);
        } else {
            return redirect()->back();
        }

    }

    /**
     * 	Preview of booking confirmation email
     */
    public function showForEmail($locale, $id)
    {
        $booking = Booking::whereId($id)->first();
        $eventSection = EventSection::where('id', $booking->event_section_id)->first();
        $event = Event::where('id', $eventSection->event_id)->first();
        $eventDetail = EventDetail::where('event_id', $booking->event->id)->first();
        $user = User::where('id', $booking->user_id)->first();

        return view('emails.booking-success')->with([
            'booking' => $booking,
            'event' => $event,
            'eventDetail' => $eventDetail,
            'user' => $user
        ]);
    }


    /**
     * 	edit booking in backend
     */
    public function edit(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'event_section_price' => 'nullable|integer|max:99999',
            'notes' => 'nullable|max:191',
            'currency' => 'nullable',
            'booking_message' => 'nullable'
        ]);
        Booking::whereId($id)->update($validatedData);

        return redirect()->back();
    }


    /**
     * 	edit booking details in backend
     */
    public function editDetails(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'arrival_ashram' => 'required|date',
            'departure_ashram' => 'required|date',
            'transportation' => 'nullable',
            'arrival_india' => 'nullable',
            'roommate_preference' => 'nullable',
            'emergency_contact' => 'nullable'
        ]);
        BookingDetail::whereId($id)->update($validatedData);

        return redirect()->back();
    }


    /**
     * 	Add Booking in frontend
     */
    public function add(Request $request)
    {
//        $devObserver = new DevObserver($request->request, auth()->user());
//        Mail::to('thomas@stenzel.pro')->send($devObserver);

        $validatedData = $request->validate([
            'event_section_id' => 'required|integer|min:1|max:99999',
            'currency' => 'required'
        ]);

        //Abfrage einbauen ob EventSection vom User schon gebucht wurde, falls ja dann return von Fehlermeldung.
        $eventSection = eventSection::where('id', $request->event_section_id)->first();
        // check if custom section price is there and use that price for the booking price
        if($request->event_section_price) {
            $eventSectionPrice = $request->event_section_price;
        }
        else {
            switch ($request->currency) {
                case 1:
                    $eventSectionPrice = $eventSection->price_usd;
                    break;
                case 2:
                    $eventSectionPrice = $eventSection->price_euro;
                    break;
                default:
                    $eventSectionPrice = 0;
                    break;
            }
        }

        $booking = Booking::create([
            'user_id' => auth()->user()['id'],
            'event_section_id' => $request->event_section_id,
            'event_section_price' => $eventSectionPrice,
            'booking_message' => $request->booking_message,
            'currency' => $request->currency
        ]);

        $event = Event::where('id', $request->event_id)->with('eventDetails')->first();
        $eventDetail = EventDetail::where('event_id', $event->id)->first();
        $user = User::where('id', $booking->user_id)->first();

        if($eventSection->has_registration) {
            $bookingRegistrationMail = new BookingRegistration($booking, $event, $eventDetail, $user);
            Mail::to(auth()->user()['email'])->send($bookingRegistrationMail);

            $booking->update([
                'status' => '1'
            ]);

            return redirect(route('iframe-booking-registration', ['language' => app()->getLocale(), 'id' => $booking->id]));
        } else {
            $bookingSuccessMail = new BookingSuccess($booking, $event, $eventDetail, $user);
            Mail::to(auth()->user()['email'])->send($bookingSuccessMail);

            return redirect(route('iframe-after-booking', ['language' => app()->getLocale(), 'id' => $booking->id]));
        }
    }


    /**
     * 	Add Booking in backend
     */
    public function addBookingByAdmin(Request $request)
    {
        // Check if the event was before 2020-08-01 to save as historic booking without create date and id less then 40000
        $eventSection = EventSection::where('id', $request->event_section_id )->with('event')->first();
        if($eventSection->event->start_date < '2020-08-01') {
            $last_ticket_id = Booking::where('id', '<', '40000')->orderBy('id', 'desc')->pluck('id')->first();
            $next_ticket_id = $last_ticket_id + 1;

            $booking = new Booking;
            $booking->id = $next_ticket_id;
            $booking->timestamps = false;
            $booking->user_id = $request->user_id;
            $booking->event_section_id = $request->event_section_id;
            $booking->booking_message = $request->booking_message;
            $booking->currency = $request->currency;

            $booking->save();
        } else {

            // Copy the price of the event section to the booking price
            switch ($request->currency) {
                case 1:
                    $eventSectionPrice = $eventSection->price_usd;
                    break;
                case 2:
                    $eventSectionPrice = $eventSection->price_euro;
                    break;
            }
            $booking = Booking::create([
                'user_id' => $request->user_id,
                'status' => '2',
                'event_section_id' => $request->event_section_id,
                'event_section_price' => $eventSectionPrice,
                'booking_message' => $request->booking_message,
                'currency' => $request->currency
            ]);

            $event = $eventSection->event;
            $eventDetail = EventDetail::where('event_id', $event->id)->first();
            $user = User::where('id', $booking->user_id)->first();

            $bookingSuccessMail = new BookingSuccess($booking, $event, $eventDetail, $user);
            Mail::to(auth()->user()['email'])->send($bookingSuccessMail);
        }

        return redirect()->back();
    }

    /**
     * 	Add Booking Details in frontend
     */
    public function addBookingDetails(Request $request)
    {

        $validatedData = $request->validate([
            'booking_id' => 'required|integer',
            'arrival_ashram' => 'required|date|before:departure_ashram',
            'departure_ashram' => 'required|date|after:arrival_ashram',
//            'transportation' => '',
//            'medical_requirements' => '',
            'roommate_preference' => '',
            'emergency_contact' => 'required',
            'agreement_to_rules' => 'required'
        ]);

        BookingDetail::updateOrCreate([
            'booking_id' => $request->booking_id
            ],
            $validatedData);

        if($request->medical_requirements) {
            $user_id = Booking::whereId($request->booking_id)->first()->user_id;
            UserAshramData::updateOrCreate([
                'id' => $user_id
            ],[
                'medical_requirements' => $request->medical_requirements
            ]);
        }

        return redirect(route('iframe-user-welcome', ['language' => app()->getLocale()]));
        //return redirect()->away('https://portal.srikaleshwar.world/en/booking/user-list');

    }

    /**
     * 	edit booking details in backend
     */
    public function addBookingDetailsByAdmin(Request $request, $locale)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|integer',
            'arrival_ashram' => 'required|date',
            'departure_ashram' => 'required|date',
            'transportation' => '',
            'medical_requirements' => '',
            'roommate_preference' => '',
            'emergency_contact' => '',
            'agreement_to_rules' => ''
        ]);

        BookingDetail::updateOrCreate([
            'booking_id' => $request->booking_id
            ],
            $validatedData);

        return redirect()->back();
    }

    /**
     * 	action for payment confirmation
     */
    public function actionBookingAccepted($locale, $id)
    {
        $booking = Booking::where('id', $id)->with('bookingDetail')->first();
        $eventSection = EventSection::where('id', $booking->event_section_id)->first();
        $event = Event::where('id', $eventSection->event_id)->first();
        $eventDetail = EventDetail::where('event_id', $event->id)->first();
        $user = User::where('id', $booking->user_id)->with('contactInformation')->first();

        $bookingAcceptance = new BookingAcceptance($booking, $event, $eventDetail, $user);
        Mail::to($user->email)->send($bookingAcceptance);

        $booking->update(['status' => '2']);

        Comment::create([
            'content' => 'Acceptance for booking sent',
            'reference_type' => 'App\Booking',
            'reference_id' => $booking->id
        ]);

        return redirect(route('booking-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }

    /**
     * 	action for payment confirmation
     */
    public function actionPaymentConfirmation($locale, $id)
    {
        $booking = Booking::find($id);
        $booking->update(['status' => '5']);
        $eventSection = EventSection::where('id', $booking->event_section_id)->first();
        $event = Event::where('id', $eventSection->event_id)->first();
        $eventDetail = EventDetail::where('event_id', $event->id)->first();
        $user = User::where('id', $booking->user_id)->with('contactInformation')->first();

        $bookingPaymentConfirmation = new BookingPaymentConfirmation($booking, $event, $eventDetail, $user);
        Mail::to($user->email)->send($bookingPaymentConfirmation);

        Comment::create([
            'content' => 'Confirmation for payment sent',
            'reference_type' => 'App\Booking',
            'reference_id' => $booking->id
        ]);

        return redirect(route('booking-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }


    /**
     * 	action for no payment
     */
    public function actionNoPaymentNecessary($locale, $id)
    {
        $booking = Booking::find($id);
        $booking->update(['status' => '6']);

        return redirect(route('booking-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }


    /**
     * 	action for payment reminder
     */
    public function actionPaymentReminder($locale, $id)
    {
        $booking = Booking::find($id);
        $eventSection = EventSection::where('id', $booking->event_section_id)->first();
        $event = Event::where('id', $eventSection->event_id)->first();
        $eventDetail = EventDetail::where('event_id', $event->id)->first();
        $user = User::where('id', $booking->user_id)->first();

        $bookingPaymentReminder = new BookingPaymentReminder($booking, $event, $eventDetail, $user);
        Mail::to($user->email)->send($bookingPaymentReminder);

        Comment::create([
            'content' => 'Reminder for payment sent',
            'reference_type' => 'App\Booking',
            'reference_id' => $booking->id
        ]);

        return redirect(route('booking-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }


    /**
     * 	action for payment reminder
     */
    public function cancelBooking($locale, $id)
    {
        $booking = Booking::find($id);
        $booking->update(['status' => '3']);

        Comment::create([
            'content' => 'Booking canceled',
            'reference_type' => 'App\Booking',
            'reference_id' => $booking->id
        ]);

        return redirect(route('booking-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }


    /**
     * 	Delete historic booking in database (only if ID is smaller then 40000)
     */
    public function deleteBookingByAdmin($locale, $id)
    {
        Booking::whereId($id)->delete();
        return redirect()->back();
    }
}
