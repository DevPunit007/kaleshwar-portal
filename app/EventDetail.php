<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EventDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'event_id', 'title', 'introduction', 'description', 'before_booking', 'intro_booking', 'closing_booking', 'after_booking', 'language'
    ];

    public function event() { return $this->hasOne('App\Event'); }
}
