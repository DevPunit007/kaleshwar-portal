<?php

namespace App\Http\Controllers;

use App\Event;
use App\Language;
use App\Organizer;
use App\OrganizerContactInformation;
use App\OrganizerDetail;
use App\OrganizerPhoneNumber;
use App\OrganizerTopicRelation;
use App\OrganizerTopicCertification;
use App\Topic;
use App\User;
use App\UserOrganizerRelation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrganizerController extends Controller
{
    public function showOrganizerList($locale, $type)
    {
        if (auth()->user()['rule_id'] === 4 | auth()->user()['rule_id'] === 5) {
            $organizers = Organizer::where('type', $type)->get();
        } else {
            $organizers = Organizer::where('type', $type)->whereHas( 'relations', function ($query) { $query->where('user_id', auth()->user()->id); } )->get();
        }


        foreach ($organizers as $organizer) {
            $organizer->editorCount = sizeof(UserOrganizerRelation::where(['organizer_id' => $organizer->id, 'role' => 'editor'])->get());
            $organizer->memberCount = sizeof(UserOrganizerRelation::where(['organizer_id' => $organizer->id, 'role' => 'member'])->get());
            $organizer->admin = UserOrganizerRelation::where(['organizer_id' => $organizer->id, 'role' => 'admin'])->with('user')->first();
            $organizer->eventCount = sizeof(Event::where([['organizer_id', $organizer->id], ['start_date', '>', date("Y-m-d")]])->get());
            $organizer->certificationCount = sizeof(OrganizerTopicCertification::where('organizer_id', $organizer->id)->get());

        }
        return view('pages.organizer.list')->with(['teachers' => $organizers, 'type' => $type]);
    }

    public function showForEdit($locale, $id)
    {
        $organizer = Organizer::where('id', $id)->with('relations.user')->with('organizerContactInformation')->with('topics')->first();
        $topics = Topic::get()->sortBy('name');

        return view('pages.organizer.edit')->with([
            'organizer' => $organizer,
            'topics' => $topics
        ]);
    }

    public function showForAdd($locale, $type)
    {
        $users = User::with('contactInformation')->get();
        return view('pages.organizer.add')->with([
            'type' => $type,
            'users' => $users
        ]);
    }

    public function add(Request $request, $locale, $type)
    {
        if($type !== 'group' && $type !== 'teacher') {
            throw ValidationException::withMessages(['type' => ['Type must either be group or teacher'],]);
        }

        $token = Str::random(10);
        if ($type === 'group') {
            $organizer = Organizer::create([
                'organizer_name' => $request->organizer_name,
                'organizer_email' => $request->organizer_email,
                'type' => 'group',
                'token' => $token,
            ]);
            UserOrganizerRelation::create([
                'user_id' => $request->admin_id,
                'organizer_id' => $organizer->id,
                'role' => 'admin'
            ]);
        }
        if ($type === 'teacher') {
            $user = User::where(['id' => $request->admin_id])->with('contactInformation')->first();
            Organizer::create([
                'organizer_name' => $user->first_name . ' ' . $user->last_name,
                'organizer_email' => $request->organizer_email,
                'type' => 'teacher',
                'admin_id' => $request->admin_id,
                'token' => $token,
            ]);
        }

        return redirect()->route($type . '-list', ['language' => app()->getLocale()]);
    }

    /**
     *
     * 	Create Teacher and Connect with User
     *
     */
    public function addTeacherByUser($locale, $id)
    {
        $user = User::where('id', $id)->with('contactInformation')->first();

        $token = Str::random(10);
        $teacher = Organizer::create([
            'organizer_name' => $user->first_name.' '.$user->last_name,
            'type' => 'teacher',
            'organizer_email' => $user->email,
            'token' => $token,
            'status' => '2',
            'is_visible' => '0'
        ]);

        OrganizerContactInformation::create([
            'organizer_id' => $teacher->id,
            'city' => $user->contactInformation->city,
            'country' => $user->contactInformation->country
        ]);

        UserOrganizerRelation::create([
            'user_id' => $user->id,
            'organizer_id' => $teacher->id,
            'role' => 'admin'
        ]);

        if($user->rule_id < 3) {
            $user->update(['rule_id' => '3']);
        }

        return redirect()->back();
    }

    public function edit(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'organizer_name' => 'required',
            'organizer_email' => 'required',
            'organizer_website' => '',
            'status' => '',
            'is_visible' => ''
        ]);

        Organizer::find($id)->update($validatedData);

        return redirect()->back();
    }

    public function editAddress(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'organizer_id' => '',
            'address_street' => '',
            'address_no' => '',
            'address_supplements' => '',
            'city' => 'required',
            'zip' => '',
            'country' => 'required',
            'state' => ''
        ]);

        $organizerContactInformation =  OrganizerContactInformation::where('organizer_id', $id)->first();
        if($organizerContactInformation) {
            OrganizerContactInformation::find($id)->update($validatedData);
        } else {
            OrganizerContactInformation::create($validatedData);
        }

        return redirect()->back();
    }

    public function addTranslation(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'introduction' => '',
            'description' => ''
        ]);

        $organizer = Organizer::find($id);

        $eventDetail = OrganizerDetail::create([
            'organizer_id' => $id,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'language' => $request->organizer_language
        ]);

        return redirect(route($organizer->type .'-edit', ['language' => app()->getLocale(), 'id' => $id]));
    }

    public function showForLanguageAddition($locale, $id)
    {
        $organizer = Organizer::where('id', $id)->with('organizerDetails')->first();

        $alreadySetLanguages = [];

        foreach ($organizer->organizerDetails as $organizerDetail) {
            array_push($alreadySetLanguages, $organizerDetail->language);
        }
        $allLanguages = Language::all()->pluck('language_code')->toArray();
        $languages = array_diff($allLanguages, $alreadySetLanguages);

        if ($languages === []) {
            return redirect(route('organizer-edit', ['language' => app()->getLocale(), 'id' => $id]));
        } else {
            return view('pages.organizer.add-translation')->with([
                'organizer' => $organizer,
                'languages' => $languages,
            ]);
        }
    }

    public function editDetails(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'introduction' => '',
            'description' => '',
        ]);

        $organizerDetail = OrganizerDetail::find($id);
        $organizerDetail->update($validatedData);
        $organizer = $organizerDetail->organizer;

        return redirect(route($organizer->type . '-edit', ['language' => app()->getLocale(), 'id' => $organizer->id]));
    }

    public function addPhone(Request $request, $locale, $id) {
        $validatedData = $request->validate([
            'country_code' => '',
            'city_code' => '',
            'phone_number' => '',
            'type_of_phone' => ''
        ]);

        if($request->id) {
            OrganizerPhoneNumber::whereId($request->id)->update([
                'organizer_id' => $id,
                'country_code' => $request->country_code,
                'city_code' => $request->city_code,
                'phone_number' => $request->phone_number,
                'type_of_phone' => $request->type_of_phone
            ]);
        } else {
            OrganizerPhoneNumber::create([
                'organizer_id' => $id,
                'country_code' => $request->country_code,
                'city_code' => $request->city_code,
                'phone_number' => $request->phone_number,
                'type_of_phone' => $request->type_of_phone
            ]);
        }

        return redirect()->back();
    }

    public function changeTopics(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
           'topics' => ''
        ]);

        OrganizerTopicRelation::where('organizer_id', $id)->delete();
        if($request->topics) {
            foreach ($request->topics as $topicId => $topic) {
                OrganizerTopicRelation::create([
                   'organizer_id' => $id,
                    'topic_id' => $topicId
                ]);
            }
        }

        return redirect()->back();
    }

    public function changeCertifications(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'certifications' => ''
        ]);

        OrganizerTopicCertification::where('organizer_id', $id)->delete();
        if($request->certifications) {
            foreach ($request->certifications as $topicId => $topic) {
                OrganizerTopicCertification::create([
                    'organizer_id' => $id,
                    'topic_id' => $topicId
                ]);
            }
        }

        return redirect()->back();
    }

    public function deleteOrganizerPhone($locale, $id)
    {
        OrganizerPhoneNumber::whereId($id)->delete();
        return redirect()->back();
    }

}
