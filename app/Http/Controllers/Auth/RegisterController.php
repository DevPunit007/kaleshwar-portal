<?php

namespace App\Http\Controllers\Auth;

use App\Language;
use App\UserContactInformation;
use App\UserPersonalInformation;
use App\UserPhoneNumber;
use App\UserSpiritualHistory;
use App\UserAshramData;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/en/iframe/user-account-basic';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user && $user->status === 3) {
            return $this->sendLockedAccountResponse($request);
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

    protected function sendLockedAccountResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => 'Your account was deleted. Please contact us if you want to reverse it.'
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $languages = Language::all();
        return view('pages.auth.register')->with('languages', $languages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'rule_id' => '1', // because a newly registered user should always have the rule 'visitor', this can be statically set to 1
            'password' => Hash::make($data['password']),
            'language_code' => $data['language_code'],
            'status' => '1',
            'last_login' => Carbon::now()
        ]);

        UserContactInformation::create([
            'id' => $user->id,
            'country' => $data['country']
        ]);

        UserPersonalInformation::create([
            'id' => $user->id
        ]);

        UserSpiritualHistory::create([
            'id' => $user->id
        ]);

        $checked = isset($data['newsletter']) ? 1 : 0;
        UserAshramData::create([
            'id' => $user->id,
            'newsletter' => $checked
        ]);

        return $user;
    }
}
