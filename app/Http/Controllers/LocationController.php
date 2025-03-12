<?php

namespace App\Http\Controllers;

use App\Building;
use App\Language;
use App\Location;
use App\LocationDetail;
use App\Room;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function showList()
    {
        $locations = Location::with('locationDetails')->get();

        foreach ($locations as $location) {
            $location->roomCount = sizeof(Room::where(['location_id' => $location->id])->get());
            $location->eventCount = sizeof(Event::where(['location_id' => $location->id])->get());
        }

        $rooms = Room::all();
        $buildings = Building::all();

        return view('pages.location.list')->with([
            'locations' => $locations,
            'rooms' => $rooms,
            'buildings' => $buildings
        ]);
    }

    public function showForAdd()
    {
        $languages = Language::all();

        return view('pages.location.add')->with([
            'languages' => $languages
        ]);
    }

    public function add(Request $request, $locale)
    {
        $location = Location::create([
            'geodata' => $request->geodata,
            'creator_id' => auth()->user()->id,
        ]);

        LocationDetail::create([
            'location_id' => $location->id,
            'name' => $request->name,
            'address_street' => $request->address_street,
            'address_no' => $request->address_no,
            'address_supplements' => $request->address_supplements,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'language' => $request->language
        ]);

        return redirect()->back();
    }

    public function showForLanguageAddition($locale, $id)
    {
        $location = Location::where('id', $id)->with('locationDetails')->first();
        $alreadySetLanguages = [];
        foreach ($location->locationDetails as $locationDetail) {
            array_push($alreadySetLanguages, $locationDetail->language);
        }

        $allLanguages = Language::all()->pluck('language_code')->toArray();
        $languages = array_diff($allLanguages, $alreadySetLanguages);

        if ($languages === []) {
            return redirect(route('location-edit', ['language' => app()->getLocale(), 'id' => $id]));
        } else {
            return view('pages.location.add-translation')->with([
                'location' => $location,
                'languages' => $languages,
            ]);
        }
    }

    public function addTranslation(Request $request, $locale, $id)
    {
        LocationDetail::create([
            'location_id' => $id,
            'name' => $request->name,
            'address_street' => $request->address_street,
            'address_no' => $request->address_no,
            'address_supplements' => $request->address_supplements,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'language' => $request->language
        ]);

        return redirect()->back();
    }

    public function showRoomList()
    {
        $rooms = Room::all();

        return view('pages.location.room-list')->with([
            'rooms' => $rooms,
        ]);
    }

    public function showRoomForEdit($locale, $id)
    {
        $room = Room::find($id);
        return view('pages.location.room-edit')->with([
            'room' => $room,
        ]);
    }

    public function editRoom(Request $request, $locale, $id)
    {
        DB::table('rooms')->where('id', $id)->update([
            'name' => $request->name,
            'is_for_events' => boolval($request->is_for_events),
            'is_blocked' => boolval($request->is_blocked),
            'reason_why_blocked' => $request->reason_why_blocked,
            'maximum_guests' => $request->maximum_guests,
            'size' => $request->size,
            'floor' => $request->floor,
            'description' => $request->description
        ]);

        return redirect()->back();
    }

    public function showForEdit($locale, $id)
    {
        $location = Location::where('id', $id)->with('locationDetails')->with('buildings')->first();
        return view('pages.location.edit')->with([
            'location' => $location
        ]);
    }

    public function edit(Request $request, $locale, $id) {

        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        DB::table('location_details')->where('location_id', $id)->update([
            'name' => $request->name,
            'address_street' => $request->address_street,
            'address_no' => $request->address_no,
            'address_supplements' => $request->address_supplements,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country
        ]);

        return redirect()->back();
    }

    public function addRoom() {
        // @todo hier fehlt noch was

        return redirect()->back();
    }

    public function showRoomForAdd() {
        $locations = Location::with('locationDetails')->get();
        $buildings = Building::all();

        return view('pages.location.room-add')->with([
           'locations' => $locations,
           'buildings' => $buildings
        ]);
    }

    public function editBuilding(Request $request, $locale, $id)
    {
        DB::table('buildings')->where('id', $id)->update([
           'name' => $request->name
        ]);
        return redirect()->back();
    }

    public function addBuilding(Request $request, $locale)
    {
        Building::create([
            'location_id' => $request->location_id,
            'name' => $request->name
        ]);
        return redirect()->back();
    }

    public function ajaxGetRooms($locationId)
    {
        $location = Location::find($locationId);
        $rooms = Room::where('location_id', $location->id)->get();
        return $rooms;
    }
}

