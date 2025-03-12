<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserPersonalInformation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'date_of_birth',
        'time_of_birth',
        'place_of_birth',
        'gender',   // 1-male, 2-female
        'married',   // 1-no, 2-yes
        'name_of_spouse',
        'name_of_father',
        'name_of_mother',
        'born_as_nth',
        'profession'
    ];

    public function user() { return $this->hasOne('App\User'); }
}
