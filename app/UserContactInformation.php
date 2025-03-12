<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserContactInformation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'address_street',
        'address_no',
        'address_supplements',
        'city',
        'zip',
        'state',
        'country'
    ];

    public function user() { return $this->hasOne('App\User'); }
}
