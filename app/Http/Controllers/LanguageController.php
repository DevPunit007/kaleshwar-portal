<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LanguageController extends Controller
{
    public function ajaxGetStates($country)
    {
        $states = Lang::get('states.' . $country);
        if (is_array($states)) {
            return $states;
        } else {
            return null;
        }
    }
}
