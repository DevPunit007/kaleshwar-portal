<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BookingDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'booking_id',
        'arrival_ashram',
        'departure_ashram',
        'arrival_india',
        'transportation',
        'roommate_preference',
        'emergency_contact',
        'agreement_to_rules'
    ];
}
