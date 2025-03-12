<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserAshramData extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'user_status',
        'newsletter',
        'attend_ie2011',
        'comments',
        'reference'
    ];

    public function user() { return $this->hasOne('App\User'); }

    /**
     * Accessors for name
     */
    public function getAttendIe2011NameAttribute() {
        switch ($this->attend_ie2011) {
            case 0:
                return 'No';
                break;
            case 1:
                return 'Yes';
                break;
            default:
                return 'Unknown';
                break;
        }
    }
}
