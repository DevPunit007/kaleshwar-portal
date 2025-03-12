<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserPhoneNumber extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id', 'country_code', 'city_code', 'phone_number', 'type_of_phone'
    ];

    public function user() { return $this->hasOne('App\User'); }
    public function getTypeOfPhoneNameAttribute()
    {
        switch($this->type_of_phone) {
            case 1:
                return __('iframe-user-account.private');
                break;
            case 2:
                return __('iframe-user-account.office');
                break;
            case 3:
                return __('iframe-user-account.mobile');
                break;
            case 4:
                return __('iframe-user-account.other');
                break;
            default:
                return 'n/a';
                break;
        }
    }
}

