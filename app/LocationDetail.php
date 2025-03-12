<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LocationDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'location_id', 'name', 'address_street', 'address_no', 'address_supplements', 'city', 'state', 'zip', 'country', 'language',
    ];
}
