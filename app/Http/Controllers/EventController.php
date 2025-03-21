<?php

namespace App\Http\Controllers;

use App\Booking;
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
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Event;
use App\EventDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // return "s";
        /*$events = Event::where('end_date', '>', date("Y-m-d"))->with('contactInformation', 'eventCategory', 'eventDetails', 'organizer', 'locationDetails', 'eventSections.eventSectionDetails');
        $eventCategories = EventCategory::all();
        $token = $request->get('token');
        $filter = $request->get('filter');

        if (Route::current()->getName() === 'iframe') {
            if ($token && (strlen($token) === 20)) {
                if ($filter && ($filter === 1 || $filter === '1' || $filter === true || $filter === 'true')) {
                    // the events are filtered. There can be events shown that don't belong to the organizer
                } else {
                    $organizer = Organizer::where('token', $token)->get('id')->first();
                    if ($organizer) {
                        $events = $events->where('organizer_id', $organizer->id);
                    } else {
                        return view('pages.iframe-error');
                    }
                }
            } else {
                return view('pages.iframe-error');
            }
        }

        $events = $events->get(); */
        $path = $request->path();

        if ($path === '/') {
//            if (auth()->user() && auth()->user()->language_code) {
//                return redirect('/' . auth()->user()->language_code)->with('events', $events);
//            } elseif (app()->getLocale()) {
//                return redirect('/' . app()->getLocale());
//            } else {
//                return redirect('/en');
//            }
            // dd(app()->getLocale());
            if (app()->getLocale()) {
                return redirect('/' . app()->getLocale());
            } else {
                return redirect('/en');
            }

        } else {
            /*if (Route::current()->getName() === 'iframe') {
                return view('pages.start-iframe')->with([
                    'events' => $events,
                    'eventCategories' => $eventCategories
                ]);
            } else {*/
                // return "d";
                return view('pages.start');
            //}
        }
    }

    public function showList()
    {
        if (auth()->user()['rule_id'] === 4 | auth()->user()['rule_id'] === 5) {
            $eventsWhereUserIsAdmin = Event::with('eventDetails')->with('eventCategory')->with('organizer')->with('locationDetails')->get();  /*LocationDetail Model eingefügt */
            $eventsWhereUserIsEditor = [];
        } else {
            $eventOrganizerAdminIds = UserOrganizerRelation::where('user_id', auth()->user()->id)->where('role', 'admin')->with('organizer')->get()->pluck('organizer')->pluck('id')->flatten();
            $eventOrganizerEditorIds = UserOrganizerRelation::where('user_id', auth()->user()->id)->where('role', 'editor')->with('organizer')->get()->pluck('organizer')->pluck('id')->flatten();

            $eventsWhereUserIsAdmin = Event::whereIn('organizer_id', $eventOrganizerAdminIds)->with('eventDetails')->with('eventCategory')->with('organizer')->with('locationDetails')->get();
            $eventsWhereUserIsEditor = Event::whereIn('organizer_id', $eventOrganizerEditorIds)->with('eventDetails')->with('eventCategory')->with('organizer')->with('locationDetails')->get();
        }

        return view('pages.event.list')->with([
            'eventsWhereUserIsAdmin' => $eventsWhereUserIsAdmin,
            'eventsWhereUserIsEditor' => $eventsWhereUserIsEditor,
        ]);
    }

    public function showForAdd()
    {
        if (auth()->user()['rule_id'] === 4 | auth()->user()['rule_id'] === 5) {
            $eventCategories = EventCategory::all();
            $organizers = Organizer::all();
            $locations = Location::with('locationDetail')->get();
            $languages = Language::all();

            return view('pages.event.add')->with([
                'eventCategories' => $eventCategories,
                'organizers' => $organizers,
                'locations' => $locations,
                'languages' => $languages
            ]);
        } else {
            return redirect(route('home', app()->getLocale()));
        }
    }

    public function showForEdit($locale, $id)
    {
        $event = Event::where('id', $id)->with('eventDetails', 'eventSections', 'eventSections.eventSectionDetails')->first();
        $eventCategories = EventCategory::all();
        $setCategoryId = EventCategory::find($event->event_category_id)->id;
        $setContactPerson = User::find($event->event_contact_person_id);
        $locations = Location::with('locationDetails')->get();
        $rooms = Room::where('location_id', $event->location_id)->get();

        if (auth()->user()['rule_id'] === 4 | auth()->user()['rule_id'] === 5) {
            $eventOrganizers = Organizer::all();
            //$availableContactPeople = UserOrganizerRelation::get()->pluck('user')->flatten()->unique();
        } else {
            $eventOrganizers = UserOrganizerRelation::where('user_id', auth()->user()->id)->where('role', 'admin')->with('organizer')->get()->pluck('organizer')->flatten();
            //$availableContactPeople = UserOrganizerRelation::whereIn('organizer_id', $eventOrganizers->pluck('id'))->whereIn('role', ['editor', 'admin'])->with('contactInformation')->get()->pluck('user')->flatten()->unique();
        }
        $setEventOrganizer = Organizer::find($event->organizer_id)->id;

        return view('pages.event.edit')->with([
            'event' => $event,
            'eventCategories' => $eventCategories,
            'setCategoryId' => $setCategoryId,
            'setContactPerson' => $setContactPerson,
            //'availableContactPeople' => $availableContactPeople,
            'setEventOrganizer' => $setEventOrganizer,
            'eventOrganizers' => $eventOrganizers,
            'locations' => $locations,
            'rooms' => $rooms
        ]);
    }

    public function showForSectionEdit($locale, $id)
    {
        $eventSection = EventSection::where('id', $id)->with('EventSectionDetails')->first();
        return view('pages.event.section-edit')->with([
            'eventSection' => $eventSection
        ]);
    }

    public function showForSectionAdd($locale, $id)
    {
        $languages = Language::all();

        return view('pages.event.section-add')->with([
            'eventId' => $id,
            'languages' => $languages
        ]);
    }

    public function editSection(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
//            'start_date' => 'nullable|date',
//            'end_date' => 'nullable|date',
//            'start_time' => 'nullable|date_format:H:i',
//            'end_time' => 'nullable|date_format:H:i',
//            'has_own_date' => '',
            'has_registration' => '',
            'price_usd' => '',
            'price_euro' => '',
            'is_visible' => '',
            'is_topic' => '',
            'is_bookable' => '',
            'is_discounted' => ''
        ]);

//        $hasOwnDate = $request->has_own_date ? 1 : 0;
        $has_registration = $request->has_registration ? 1 : 0;
        $isVisible = $request->is_visible ? 1 : 0;
        $isTopic = $request->is_topic ? 1 : 0;
        $isBookable = $request->is_bookable ? 1 : 0;
        $isDiscounted = $request->is_discounted ? 1 : 0;

        DB::table('event_sections')->where('id', '=', $id)->update([
//            'start_date' => $request->start_date,
//            'end_date' => $request->end_date,
//            'start_time' => $request->start_time,
//            'end_time' => $request->end_time,
            'price_usd' => $request->price_usd,
            'price_euro' => $request->price_euro,
//            'has_own_date' => $hasOwnDate,
            'has_registration' => $has_registration,
            'is_visible' => $isVisible,
            'is_topic' => $isTopic,
            'is_bookable' => $isBookable,
            'is_discounted' => $isDiscounted
        ]);

        return redirect()->back();
    }

    public function addSection(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'price_usd' => '',
            'price_euro' => '',
            'is_visible' => '',
            'is_topic' => '',
            'is_bookable' => '',
            'is_discounted' => '',
            'title' => 'required'
        ]);

        $isVisible = $request->is_visible ? 1 : 0;
        $isTopic = $request->is_topic ? 1 : 0;
        $isBookable = $request->is_bookable ? 1 : 0;
        $isDiscounted = $request->is_discounted ? 1 : 0;

        $eventSection = EventSection::create([
            'event_id' => $id,
            'price_usd' => $request->price_usd,
            'price_euro' => $request->price_euro,
            'is_visible' => $isVisible,
            'is_topic' => $isTopic,
            'is_bookable' => $isBookable,
            'is_discounted' => $isDiscounted
        ]);

        EventSectionDetail::create([
            'event_section_id' => $eventSection->id,
            'language' => 'en',
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect(route('event-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }

    public function editSectionDetails(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => '',
        ]);

        DB::table('event_section_details')->where([['id', '=', $id], ['language', '=', $request->language]])->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }

    public function showSectionForLanguageAddition($locale, $id) {
        $eventSection = EventSection::where('id', $id)->with('eventSectionDetails')->first();
        $alreadySetLanguages = [];

        foreach ($eventSection->eventSectionDetails as $eventSectionDetails) {
            array_push($alreadySetLanguages, $eventSectionDetails->language);
        }

        $allLanguages = Language::all()->pluck('language_code')->toArray();
        $languages = array_diff($allLanguages, $alreadySetLanguages);

        return view('pages.event.section-add-translation')->with([
            'eventSection' => $eventSection,
            'languages' => $languages
        ]);
    }

    public function addSectionTranslation(Request $request, $locale, $id)
    {
        EventSectionDetail::create([
            'event_section_id' => $id,
            'title' => $request->title,
            'description' => $request->description,
            'language' => $request->language
        ]);

        return redirect(route('event-section-edit', ['language' => app()->getLocale(), 'id' => $id]));

    }

    public function showForLanguageAddition($locale, $id)
    {
        $event = Event::where('id', $id)->with('eventDetails')->first();
        $eventCategories = EventCategory::all();
        $alreadySetLanguages = [];

        foreach ($event->eventDetails as $eventDetails) {
            array_push($alreadySetLanguages, $eventDetails->language);
        }
        $allLanguages = Language::all()->pluck('language_code')->toArray();
        $languages = array_diff($allLanguages, $alreadySetLanguages);

        if ($languages === []) {
            return redirect(route('event-edit', ['language' => app()->getLocale(), 'id' => $id]));
        } else {
            return view('pages.event.add-translation')->with([
                'event' => $event,
                'eventCategories' => $eventCategories,
                'languages' => $languages,
            ]);
        }
    }

    public function add(Request $request, $locale)
    {
        $validatedData = $request->validate([
            'event_category_id' => 'required',
            'event_contact_person_id' => 'required',
            'organizer_id' => 'required',
            'list_name' => 'required',
            'start_date' => 'date',
            'end_date' => 'date',
            //'end_time' => '',
            'title' => 'required',
            'before_booking' => '',
            'location_id' => 'required',
            'introduction' => '',
            'description' => '',
            'intro_booking' => '',
            'closing_booking' => '',
            'event_language' => '',
            'use_booking' => 'required',
            'after_booking' => ''
        ]);

        //dd($validatedData);
        //$validatedData['start_date'] = $validatedData['start_date'] ? Carbon::create($validatedData['start_date']) : $validatedData['start_date'];
        //$validatedData['end_date'] = $validatedData['end_date'] ? Carbon::create($validatedData['start_date']) : $validatedData['end_date'];

        $event = Event::create([
            'list_name' => $validatedData['list_name'],
            'event_category_id' => $validatedData['event_category_id'],
            'event_contact_person_id' => $validatedData['event_contact_person_id'],
            'location_id' => $validatedData['location_id'],
            'organizer_id' => $validatedData['organizer_id'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            //'end_time' => 'placeholder! fix me',
            'use_booking' => $validatedData['use_booking']
        ]);

        EventDetail::create([
            'event_id' => $event->id,
            'title' => $request->title,
            'before_booking' => $request->before_booking,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'intro_booking' => $request->intro_booking,
            'closing_booking' => $request->closing_booking,
            'after_booking' => $request->after_booking,
            'language' => $request->event_language
        ]);
        return redirect(route('event-list', app()->getLocale()));
    }

    public function edit(Request $request, $locale, $id)
    {
        $request['is_visible'] = $request->is_visible ? 1 : 0;
        $request['has_date'] = $request->has_date ? 1 : 0;

        $validatedData = $request->validate([
            'event_category_id' => 'required',
            'organizer_id' => 'required',
            'event_contact_person_id' => '',
            'list_name' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|required_if:has_date,1',
            //'end_time' => 'date_format:H:i',
            'location_id' => 'required',
        ]);

        DB::table('events')->where('id', $id)->update([
            'list_name' => $request->list_name,
            'event_category_id' => $request->event_category_id,
            'organizer_id' => $request->organizer_id,               /*Reihenfolge geändert, wie in DB */
            'event_contact_person_id' => $request->event_contact_person_id,
            'location_id' => $request->location_id,                    /*location_id eingefügt und location aus Details entfernt */
            //'room_id' => $request->room_id,
            'is_visible' => $request->is_visible,
            'has_date' => $request->has_date,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            //'end_time' => $request->end_time,
            'use_booking' => $request->use_booking
        ]);

        return redirect(route('event-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }

    public function editDetails(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'before_booking' => '',
            'introduction' => '',
            'description' => '',
            'intro_booking' => '',
            'closing_booking' => '',
            'after_booking' => ''
        ]);

        DB::table('event_details')->where([['event_id', '=', $id], ['language', '=', $request->language]])->update([
            'title' => $request->title,
            'before_booking' => $request->before_booking,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'intro_booking' => $request->intro_booking,
            'closing_booking' => $request->closing_booking,
            'after_booking' => $request->after_booking
        ]);

        return redirect(route('event-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }


    public function addTranslation(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'event_language' => 'required',
            'title' => 'required',
            'before_booking' => '',
            'introduction' => '',
            'description' => '',
            'intro_booking' => '',
            'closing_booking' => '',
            'after_booking' => ''
        ]);

        $eventDetail = EventDetail::create([
            'event_id' => $id,
            'title' => $request->title,
            'before_booking' => $request->before_booking,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'intro_booking' => $request->intro_booking,
            'closing_booking' => $request->closing_booking,
            'after_booking' => $request->after_booking,
            'language' => $request->event_language
        ]);

        return redirect(route('event-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }

    public function cloneEvent($locale, $id)
    {
        $event = Event::where('id', $id)->with('eventDetails')->first();
        $eventSections = EventSection::where('event_id', $id)->with('eventSectionDetails')->get();

        $event_clone = $event->replicate();
        $event_clone->start_date = Carbon::today()->subDay(1);
        $event_clone->end_date = Carbon::today()->subDay(1);
        $event_clone->list_name = $event->list_name.'#';
        $event_clone->push();

        foreach ($event->eventDetails as $eventDetail) {
            $event_detail_clone = [];
            $event_detail_clone = $eventDetail->replicate();
            $event_detail_clone->event_id = $event_clone->id;
            $event_detail_clone->push();
        }
        foreach ($eventSections as $eventSection) {
            $event_section_clone = [];
            $event_section_clone = $eventSection->replicate();
            $event_section_clone->event_id = $event_clone->id;
            $event_section_clone->push();

            foreach ($eventSection->eventSectionDetails as $eventSectionDetail) {
                $event_section_detail_clone = [];
                $event_section_detail_clone = $eventSectionDetail->replicate();
                $event_section_detail_clone->event_section_id = $event_section_clone->id;
                $event_section_detail_clone->push();
            }
        }
//        foreach($event->getRelations() as $relation => $items){
//            foreach($items as $item){
//                unset($item->id);
//                $event_clone->{$relation}()->create($item->toArray());
//            }
//        }

        return redirect(route('event-edit', ['language' => app()->getLocale(), 'id' => $event_clone->id]));
    }

    public function showReportMessage($locale, $id)
    {
        $event = Event::where('id', $id)->with('eventDetails', 'eventSections', 'eventSections.eventSectionDetails')->first();
        $eventSections = $event->eventSections->pluck('id');
        $bookings = Booking::whereIn('event_section_id', $eventSections)->whereNotIn('status', [3])->with('user', 'user.contactInformation', 'user.ashramData', 'event', 'event.eventDetails', 'eventSectionDetail')->get();

        return view('pages.event.report-participants-message')->with([
            'event' => $event,
            'bookings' => $bookings
        ]);
    }

    public function showReportAddress($locale, $id)
    {
        $event = Event::where('id', $id)->with('eventDetails', 'eventSections', 'eventSections.eventSectionDetails')->first();
        $eventSections = $event->eventSections->pluck('id');
        $bookings = Booking::whereIn('event_section_id', $eventSections)->whereNotIn('status', [3])->with('user', 'user.contactInformation', 'user.ashramData', 'event', 'event.eventDetails', 'eventSectionDetail')->get();

        return view('pages.event.report-participants-address')->with([
            'event' => $event,
            'bookings' => $bookings
        ]);
    }

    public function showReportUserDetails($locale, $id)
    {
        $event = Event::where('id', $id)->with('eventDetails', 'eventSections', 'eventSections.eventSectionDetails')->first();
        $eventSections = $event->eventSections->pluck('id');
        $bookings = Booking::whereIn('event_section_id', $eventSections)->whereNotIn('status', [3])->with('user', 'user.contactInformation', 'user.ashramData', 'event', 'event.eventDetails', 'eventSectionDetail')->get();

        return view('pages.event.report-participants-user-details')->with([
            'event' => $event,
            'bookings' => $bookings
        ]);
    }

    public function showReportBookingDetails($locale, $id)
    {
        $event = Event::where('id', $id)->with('eventDetails', 'eventSections', 'eventSections.eventSectionDetails')->first();
        $eventSections = $event->eventSections->pluck('id');
        $bookings = Booking::whereIn('event_section_id', $eventSections)->whereNotIn('status', [3])->with('user', 'user.contactInformation', 'user.ashramData', 'bookingDetail', 'event', 'event.eventDetails', 'eventSectionDetail')->get();

        return view('pages.event.report-participants-booking-details')->with([
            'event' => $event,
            'bookings' => $bookings
        ]);
    }

}
