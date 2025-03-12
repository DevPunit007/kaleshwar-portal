<?php

namespace App\Http\Controllers;

use App\Booking;
use App\EventSection;
use App\Language;
use App\Organizer;
use App\UserAshramData;
use App\UserContactInformation;
use App\UserOrganizerRelation;
use App\UserPersonalInformation;
use App\UserPhoneNumber;
use App\UserSpiritualHistory;
use App\User;
use App\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth, Hash;

class UserController extends Controller
{
    /**
     *
     * 	All Entries for user list
     *
     */
    public function showListActive()
    {
        $users = User::where('status', '1')->with('ashramData', 'contactInformation', 'personalInformation', 'userRule')->withCount('bookings', 'groups')->get();

        return view('pages.user.list-active')->with([
            'users' => $users
        ]);
    }

    public function showListStatus()
    {
        $users = User::whereHas( 'ashramData', function ($query) { $query->whereNotNull('user_status'); } )->with('ashramData', 'contactInformation', 'personalInformation', 'userRule', 'bookings')->withCount('bookings', 'groups')->get();
        //$users = User::whereHas ( 'bookings.eventSection.event', function ($query) { $query->where('start_date', '>', '2016-12-31'); } )->get();
        //$users = $all_users->ashramData->whereNotNull('comment')-get();

        return view('pages.user.list')->with([
            'users' => $users
        ]);
    }

    public function showListCheck()
    {
        $users = User::has('groups')->has('bookings')->whereHas( 'ashramData', function ($query) { $query->whereNull('user_status')->orWhere('user_status', 'not like', '%confirmed%'); } )->with('ashramData', 'contactInformation', 'personalInformation', 'userRule', 'bookings')->withCount('bookings', 'groups')->get();
        //$users = User::whereHas ( 'bookings.eventSection.event', function ($query) { $query->where('start_date', '>', '2016-12-31'); } )->get();
        //$users = $all_users->ashramData->whereNotNull('comment')-get();

        return view('pages.user.list')->with([
            'users' => $users
        ]);
    }

    public function showList()
    {
        $users = User::with('contactInformation', 'ashramData', 'userRule', 'bookings')->withCount('bookings', 'groups')->get();

        return view('pages.user.list')->with([
            'users' => $users
        ]);
    }

    public function searchUser(Request $request, $locale)
    {
        $users_query = User::with('contactInformation', 'ashramData', 'userRule', 'bookings')->withCount('bookings', 'groups');

        $columns = Schema::getColumnListing('users');

        foreach($columns as $column){
            $users_query->orWhere($column, 'LIKE', '%' . $request->keyword . '%');
        }
        $users = $users_query->get();

        return view('pages.user.list')->with([
            'users' => $users,
            'keyword' => $request->keyword
        ]);
    }

    /**
     *
     * 	Form to Edit User
     *
     */
    public function showForEditBasic($locale, $id)
    {
        $user = User::whereId($id)->with('ashramData')->first();

        return view('pages.user.edit-basic')->with([
            'user' => $user
        ]);
    }

    public function showForEditContact($locale, $id)
    {
        $user = User::find($id);
        $contactInformation = UserContactInformation::find($id);

        return view('pages.user.edit-contact')->with([
            'user' => $user,
            'contactInformation' => $contactInformation
        ]);
    }

    public function showForEditPersonal($locale, $id)
    {
        $user = User::find($id);
        $personalInformation = UserPersonalInformation::find($id);

        return view('pages.user.edit-personal')->with([
            'user' => $user,
            'personalInformation' => $personalInformation
        ]);
    }

    public function showForEditSpiritual($locale, $id)
    {
        $user = User::find($id);
        $spiritualHistory = UserSpiritualHistory::find($id);

        return view('pages.user.edit-spiritual')->with([
            'user' => $user,
            'spiritualHistory' => $spiritualHistory
        ]);
    }

    public function showForEditAdditional($locale, $id)
    {
        $user = User::where('id', $id)->withCount('teacher')->first();
        $phoneNumbers = UserPhoneNumber::where('user_id', $user->id)->get();
        $userOrganizers =UserOrganizerRelation::where('user_id', $user->id)->with('organizer')->get()->sortBy('organizer_name');
        $allGroups = Organizer::where('type', 'group')->get()->sortBy('organizer_name');
        return view('pages.user.edit-additional')->with([
            'user' => $user,
            'phoneNumbers' => $phoneNumbers,
            'userOrganizers' => $userOrganizers,
            'allGroups' => $allGroups
        ]);
    }

    public function showForEditAshram($locale, $id)
    {
        $user = User::find($id);
        $ashramData = UserAshramData::find($id);

        return view('pages.user.edit-ashram')->with([
            'user' => $user,
            'ashramData' => $ashramData
        ]);
    }

    public function showForEditBookings($locale, $id)
    {
        $user = User::find($id);
        $bookings = Booking::where('user_id', $user->id)->with('user', 'event', 'event.eventDetails')->get()->sortByDesc('event.start_date');
        $eventSections = EventSection::with('event', 'event.eventDetails', 'eventSectionDetails')->get()->sortByDesc('event.start_date');

        return view('pages.user.edit-bookings')->with([
            'user' => $user,
            'bookings' => $bookings,
            'eventSections' => $eventSections
        ]);
    }

    public function showForEditFiles($locale, $id)
    {
        $user = User::find($id);
        $files = User::find($id)->files;

        return view('pages.user.edit-files')->with([
            'user' => $user,
            'files' => $files
        ]);
    }

    /**
     *
     * 	All Userdata for user account (nicht mehr in Nutzung!!!!)
     *
     */
    public function showAccount()
    {
        $user = auth()->user();
        $contactInformation = UserContactInformation::find($user->id);
        $personalInformation = UserPersonalInformation::find($user->id);
        $spiritualHistory = UserSpiritualHistory::find($user->id);
        $profileImage = $user->files->where('type', 'profile-image')->first();
        $passportImage = $user->files->where('type', 'passport-image')->first();
        $languages = Language::whereIn('id', ['1', '2'])->get();

        return view('pages.user.account')->with([
            'user' => $user,
            'contactInformation' => $contactInformation,
            'personalInformation' => $personalInformation,
            'spiritualHistory' => $spiritualHistory,
            'profileImage' => $profileImage,
            'passportImage' => $passportImage,
            'languages' => $languages
        ]);
    }


    /**
     *
     * 	Edit User in database
     *
     */
    public function editUserBasic(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:191',
            'middle_name' => 'nullable|max:191',
            'last_name' => 'required|max:191',
            'nickname' => 'nullable|max:191',
            'language_code' => 'required',
            'status' => '',
            'email' => 'required|max:191|unique:users,email,'.$id
        ]);

        if($request->password && auth()->user()->id == 8003 || auth()->user()->id == 4958) {
            $validatedData['password'] = Hash::make($request->password);
            //$user->save();
        }

        User::find($id)->update($validatedData);



        if($request->newsletter) {
            $user_additional = UserAshramData::find($id);
            if ($user_additional) {
                $user_additional->update(['newsletter' => $request->newsletter]);
            } else {
                UserAshramData::create(['id' => $id, 'newsletter' => $request->newsletter]);
            }
        }
        return redirect()->back();
    }

    public function editUserContact(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'address_street' => '',
            'address_no' => '',
            'address_supplements' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
            'country' => '',
        ]);

        $user_contact_information = UserContactInformation::find($id);
        if($user_contact_information) {
            $user_contact_information->update($validatedData);
        } else {
            UserContactInformation::create($validatedData);
        }
        return redirect()->back();
    }

    public function editUserPersonal(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'date_of_birth' => 'nullable|date',
            'time_of_birth' => 'nullable|date_format:H:i',
            'place_of_birth' => '',
            'gender' => '',
            'married' => '',
            'name_of_spouse' => '',
            'name_of_father' => '',
            'name_of_mother' => '',
            'born_as_nth' => '',
            'profession' => ''
        ]);

        $validatedData['date_of_birth'] = $validatedData['date_of_birth'] ? Carbon::create($validatedData['date_of_birth']) : $validatedData['date_of_birth'];

        $user_personal_information = UserPersonalInformation::find($id);
        if($user_personal_information) {
            $user_personal_information->update($validatedData);
        } else {
            UserPersonalInformation::create($validatedData);
        }
        return redirect()->back();
    }

    public function editUserSpiritual(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'first_meet' => '',
            'events_kaleshwar' => '',
            'processes_kaleshwar' => '',
            'ashram_visited' => ''
        ]);

        $user_spiritual_history = UserSpiritualHistory::find($id);
        if($user_spiritual_history) {
            $user_spiritual_history->update($validatedData);
        } else {
            UserSpiritualHistory::create($validatedData);
        }
        return redirect()->back();
    }

    public function editUserAshram(Request $request, $locale, $id)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'user_status' => '',
            'newsletter' => '',
            'attend_ie2011' => '',
            'comments' => ''
        ]);

        $user_ashram = UserAshramData::find($id);
        if($user_ashram) {
            $user_ashram->update($validatedData);
        } else {
            UserAshramData::create($validatedData);
        }
        if($request->status) {
            $user = User::find($id);
            $user->status = $request->status;
            $user->save();
        }

        return redirect()->back();
    }

    /**
     *
     * 	Form to Add User
     *
     */
    public function showForAdd()
    {
        $users = User::all();

        return view('pages.user.add')->with([
            'users' => $users
        ]);
    }


    /**
     *
     * 	Add User Phone
     *
     */
    public function addUserPhone(Request $request, $locale)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'country_code' => '',
            'phone_number' => '',
            'type_of_phone' => '',
        ]);

        if($request->id) {
            UserPhoneNumber::whereId($request->id)->update($validatedData);
        } else {
            UserPhoneNumber::create($validatedData);
        }

        return redirect()->back();
    }

    /**
     *
     * 	Add User Group Connection
     *
     */
    public function addUserGroup(Request $request, $locale)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'organizer_id' => 'required',
            'role' => 'required'
        ]);

        if($request->id) {
            UserOrganizerRelation::whereId($request->id)->update($validatedData);
        } else {
            UserOrganizerRelation::create($validatedData);
        }

        return redirect()->back();
    }


    /**
     *
     * 	Delete User Phone in database
     *
     */
    public function deleteUserPhone($locale, $id)
    {
        UserPhoneNumber::whereId($id)->delete();
        return redirect()->back();
    }

    /**
     *
     * 	Delete User Phone in database
     *
     */
    public function deleteUserGroup($locale, $id)
    {
        UserOrganizerRelation::whereId($id)->delete();
        return redirect()->back();
    }

    public function showSettings()
    {
        $languages = Language::whereIn('id', ['1', '2'])->get();
    }
}
