<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserSpiritualHistory extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'first_meet',
        'events_kaleshwar',
        'processes_kaleshwar',
        'ashram_visited'
    ];
    public function user() { return $this->hasOne('App\User'); }

    /**
     * Accessors for name
     */
    public function getAshramVisitedNameAttribute() {
        switch ($this->ashram_visited) {
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
