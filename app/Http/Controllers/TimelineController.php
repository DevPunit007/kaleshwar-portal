<?php

namespace App\Http\Controllers;

use App\TimelineDate;
use App\TimelineMedia;
use App\Location;
use App\LocationDetail;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimelineController extends Controller
{
	/**
	* 	All Entries for list
	*/
	public function showListMedia()
    {
        $timeline_media = TimelineMedia::with('events', 'eventDetails', 'locations', 'locationDetails')->get();

        return view('pages.timeline.list-media')->with('timeline_media', $timeline_media);
    }



    /**
     * 	Form to Edit Media Content
     */
    public function showMediaForEdit($locale, $id) {
		$timeline_media = TimelineMedia::where('id', $id)->first();
    	$locations = Location::with('locationDetail')->get()->sortBy('locationDetail.country');
        $events = Event::where('organizer_id', '1')->with('eventDetails')->get()->sortBy('start_date');

        return view('pages.timeline.add-edit-media')->with([
 			'timeline_media' => $timeline_media,
           	'locations' => $locations,
           	'events' => $events
        ]);
    }

    /**
     * 	Edit Media Content in database
     */
    public function editMedia(Request $request, $locale, $id)
    {
        $timeline_media = TimelineMedia::find($id);
        $timeline_media->update([
            'date' => $request->date,
            'time' => $request->time,
            'event_id' => $request->event_id,
            'content' => $request->content,
            'location_id' => $request->location_id,
            'location_info' => $request->location_info,
            'type' => $request->type,
            'format' => $request->format,
            'speaker' => $request->speaker,
            'translation' => $request->translation,
            'quality' => $request->quality,
            'duration' => $request->duration,
            'notes' => $request->notes,
            'reference_info' => $request->reference_info
        ]);

        return redirect()->back();
    }

    /**
     * 	Form to Add Media Content
     */
    public function showMediaForAdd() {
        $locations = Location::with('locationDetail')->get()->sortBy('locationDetail.country');
        $events = Event::where('organizer_id', '1')->with('eventDetails')->get()->sortBy('start_date');

        return view('pages.timeline.add-edit-media')->with([
            'locations' => $locations,
            'events' => $events,
            'timeline_media' => null
        ]);
    }

    /**
    * 	Add Media Content in database
    */
    public function addMedia(Request $request, $locale)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'location_id' => 'required',
            'type' => 'required',
            'content' => 'required'
        ]);

        $validatedData['date'] = Carbon::create($validatedData['date']);

        $timeline_media = TimelineMedia::create([
            'date' => $validatedData['date'],
            'time' => $request->time,
            'event_id' => $request->event_id,
            'content' => $request->content,
            'location_id' => $request->location_id,
            'location_info' => $request->location_info,
            'type' => $request->type,
            'format' => $request->format,
            'speaker' => $request->speaker,
            'translation' => $request->translation,
            'quality' => $request->quality,
            'duration' => $request->duration,
            'notes' => $request->notes,
            'reference_info' => $request->reference_info
        ]);

		$locations = Location::with('locationDetails')->get()->sortBy('name');
        $events = Event::where('organizer_id', '1')->with('eventDetails')->get()->sortBy('start_date');

        return view('pages.timeline.add-edit-media')->with([
            'status' => 'success',
            'timeline_media' => $timeline_media,
            'locations' => $locations,
           	'events' => $events
        ]);
    }

}
