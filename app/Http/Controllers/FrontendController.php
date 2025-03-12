<?php

namespace App\Http\Controllers;

use App\Booking;
use App\File;
use App\Topic;
use App\UserContactInformation;
use App\EventCategory;
use App\EventSection;
use App\EventSectionDetail;
use App\Language;
use App\Location;
use App\Organizer;
use App\Room;
use App\User;
use App\UserOrganizerRelation;
use App\UserPersonalInformation;
use App\UserPhoneNumber;
use App\UserSpiritualHistory;
use Illuminate\Http\Request;
use App\Event;
use App\EventDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::where('end_date', '>', date("Y-m-d"))->where('is_visible', true)->where('has_date', true)->with('eventDetails', 'organizer', 'contactInformation', 'eventCategory', 'locationDetails', 'eventSections.eventSectionDetails');
        $eventCategories = EventCategory::all();
        $token = $request->get('token');
        $filter = $request->get('filter');
        $event_id = $request->get('id');
        $events = $events->get();

        if (Route::current()->getName() === 'iframe') {
            if ($token && (strlen($token) === 20)) {
                if ($filter && ($filter === 1 || $filter === '1' || $filter === true || $filter === 'true')) {
                    // the events are filtered. There can be events shown that don't belong to the organizer
                } else {
                    $organizer = Organizer::where('token', $token)->get('id')->first();
                    if ($organizer) {

                    	if($event_id) {
                    		$event = Event::where('id', $event_id)->with('eventDetails')->with('organizer')->with('contactInformation')->with('locationDetails')->first();
							//$eventCategory = EventCategory::find($event->event_category_id);
							return view('pages.iframe.details')->with([
								'event' => $event,
								//'eventCategory' => $eventCategory
							]);

                    	} else {
							$events = $events->where('organizer_id', $organizer->id)->sortBy('end_date');
							return view('pages.iframe.list')->with([
								'events' => $events,
								'eventCategories' => $eventCategories
							]);
						}

                    } else {
                        return view('pages.iframe.error');
                    }
                }
            } else {
                return view('pages.iframe.error');
            }
        } else {

            $path = $request->path();

            if ($path === '/') {
                if (auth()->user() && auth()->user()->language_code) {
                    return redirect('/' . auth()->user()->language_code)->with('events', $events);
                } elseif (app()->getLocale()) {
                    return redirect('/' . app()->getLocale());
                } else {
                    return redirect('/en');
                }
            } /*else {
                if (Route::current()->getName() === 'iframe') {
                    return view('pages.iframe.list')->with([
                        'events' => $events,
                        'eventCategories' => $eventCategories
                    ]);
                } else {
                    return view('pages.start')->with([
                        'events' => $events,
                        'eventCategories' => $eventCategories
                    ]);
                }
            } */
        }
    }

    public function show($locale, $id)
    {
        $event = Event::where('id', $id)->with('organizer')->with('contactInformation')->with('locationDetails')->first();
        $eventCategory = EventCategory::find($event->event_category_id);
        return view('pages.iframe.details')->with([
            'event' => $event,
            'eventCategory' => $eventCategory
        ]);
    }

    public function showForBooking($locale, $id)
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        $booking_event_sections = $bookings->pluck(['event_section_id']);
        $event = Event::where('id', $id)->with('eventDetails')->first();
        $eventCategory = EventCategory::find($event->event_category_id);
        $user = User::where('id', auth()->user()->id)->with('ashramData')->first();

        return view('pages.iframe.booking')->with([
            'booking_event_sections' => $booking_event_sections,
            'event' => $event,
            'eventCategory' => $eventCategory,
            'user' => $user,
            'eventOffers' => '0'
        ]);
    }

    public function showForRegistration($locale, $id)
    {
        $booking = Booking::find($id);
        $event = Event::where('id', $booking->event->id)->first();
        return view('pages.iframe.booking-registration')->with([
            'status' => 'success',
            'event' => $event,
            'booking' => $booking,
        ]);
    }

    public function showAfterBooking($locale, $id)
    {
        $booking = Booking::find($id);
        $event = Event::where('id', $booking->event->id)->first();
        return view('pages.iframe.after-booking')->with([
            'status' => 'success',
            'event' => $event,
            'booking' => $booking,
        ]);
    }

    // User Account Section
    public function showUserWelcome()
    {
        $user = auth()->user();

        return view('pages.iframe.user-account-welcome')->with([
            'user' => $user
        ]);
    }

    public function showUserAccountBasic()
    {
        $user = User::whereId(auth()->user()->id)->with('ashramData')->first();

        return view('pages.iframe.user-account-basic')->with([
            'user' => $user
        ]);
    }

    public function showUserAccountContact()
    {
        $user = auth()->user();
        $contactInformation = UserContactInformation::find($user->id);

        return view('pages.iframe.user-account-contact')->with([
            'user' => $user,
            'contactInformation' => $contactInformation
        ]);
    }

    public function showUserAccountPersonal()
    {
        $user = auth()->user();
        $personalInformation = UserPersonalInformation::find($user->id);

        return view('pages.iframe.user-account-personal')->with([
            'user' => $user,
            'personalInformation' => $personalInformation
        ]);
    }

    public function showUserAccountSpiritual()
    {
        $user = auth()->user();
        $spiritualHistory = UserSpiritualHistory::find($user->id);

        return view('pages.iframe.user-account-spiritual')->with([
            'user' => $user,
            'spiritualHistory' => $spiritualHistory
        ]);
    }

    public function showUserAccountAdditional()
    {
        $user = auth()->user();
        $phoneNumbers = UserPhoneNumber::where('user_id', $user->id)->get();
        $userOrganizers =UserOrganizerRelation::where('user_id', $user->id)->with('organizer')->get()->sortBy('organizer_name');
        return view('pages.iframe.user-account-additional')->with([
            'user' => $user,
            'phoneNumbers' => $phoneNumbers,
            'userOrganizers' => $userOrganizers
        ]);
    }



    /**
     * 	All Entries for list
     */
    public function showUserFiles()
    {
        $user = auth()->user();
        $userBookings = Booking::where('user_id', $user->id)->with('event')->get()->pluck('event.id')->toArray();
        $files = File::where('reference_type', 'App\Event')->whereIn('reference_id', $userBookings)->with('uploader', 'reference')->get()->sortByDesc('reference.start_date')->sortByDesc('created_at')->groupBy('reference.display_name');
        return view('pages.iframe.user-account-files')->with([
            'user' => $user,
            'files' => $files
        ]);
    }

    /**
     * 	Show Media
     */
    public function showFile($locale, $id) {
        $file = File::where('id', $id)->first();
        return view('pages.iframe.user-account-file-show')->with([
            'file' => $file
        ]);
    }

    /**
     * 	Show Organizer List
     */
    public function showOrganizerList()
    {
        $organizers = Organizer::where('status', 1)->where('is_visible', 1)->get();
        $topics = Topic::where('certification', 0)->get();
        $teachings = Topic::where('certification', 1)->get();
        return view('pages.iframe.organizer-list')->with([
            'organizers' => $organizers,
            'topics' => $topics,
            'teachings' => $teachings
        ]);
    }

    /**
     * 	Show Organizer Details
     */
    public function showOrganizerDetails($locale, $id)
    {
        $organizer = Organizer::find($id);
        return view('pages.iframe.organizer-details')->with([
            'organizer' => $organizer,
        ]);
    }

    /*public function addUser($locale, $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'newsletter' => '',
            'language_code' => ''
        ]);

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'rule_id' => '1', // because a newly registered user should always have the rule 'visitor', this can be statically set to 1
            'password' => Hash::make($request['password']),
            'language_code' => $request['language_code']
        ]);

        $contactInformation = UserContactInformation::create([
            'user_id' => $user->id
        ]);

        $personalInformation = UserPersonalInformation::create([
            'user_id' => $user->id
        ]);

        $spiritualHistory = UserSpiritualHistory::create([
            'user_id' => $user->id
        ]);

        return view('pages.iframe.user-account')->with([
            'user' => $user,
            'contactInformation' => $contactInformation,
            'personalInformation' => $personalInformation,
            'spiritualHistory' => $spiritualHistory
        ]);

    }*/


    public function showRegistrationForm()
    {
        if(auth()->user()) {
            $user = auth()->user();
            $contactInformation = UserContactInformation::find($user->id);
            $personalInformation = UserPersonalInformation::find($user->id);
            $spiritualHistory = UserSpiritualHistory::find($user->id);

            return view('pages.iframe.user-account-basic')->with([
                'user' => $user,
                'contactInformation' => $contactInformation,
                'personalInformation' => $personalInformation,
                'spiritualHistory' => $spiritualHistory
            ]);
        }
        else {
            $languages = Language::all();
            return view('pages.iframe.user-register')->with('languages', $languages);
        }
    }

    public function userLogout(Request $request)  {
        //$this->guard()->logout();
        Auth::logout();
        $request->session()->invalidate();

        return redirect(route('iframe-user-account-basic', app()->getLocale()));
    }
}
