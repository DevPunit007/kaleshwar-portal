<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrganizerPhoneNumber extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function getTypeOfPhoneNameAttribute()
    {
        switch($this->type_of_phone) {
            case 1:
                return __('iframe-user-account.private');
            case 2:
                return __('iframe-user-account.office');
            case 3:
                return __('iframe-user-account.mobile');
            case 4:
                return __('iframe-user-account.other');
            default:
                return 'n/a';
        }
    }
}
