<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditsController extends Controller
{
    public function index() {
        $audits = Audit::where('created_at', '>', '2021-07-01')->get()->sortByDesc('created_at');
        return view('pages.audits.show-audits')->with('audits', $audits);
    }
}
