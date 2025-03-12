<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Room extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'location_id', 'building_id', 'name', 'is_for_event', 'is_blocked', 'reason_why_blocked', 'maximum_guests', 'size', 'floor', 'description',
    ];
}
