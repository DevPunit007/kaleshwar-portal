<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TimelineMedia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'date', 'time', 'event_id', 'content', 'location_id', 'location_info', 'type', 'format', 'speaker',  'translation', 'quality', 'duration', 'notes', 'reference_id', 'reference_info' 
    ];
    
    public function events() { return $this->hasMany('App\Event', 'id', 'event_id'); }
    public function eventDetails() { return $this->hasManyThrough('App\EventDetail', 'App\Event' , 'id', 'event_id', 'event_id', 'id'); }
	public function locations() { return $this->hasMany('App\Location', 'id', 'location_id'); }
	public function locationDetails() { return $this->hasManyThrough('App\LocationDetail', 'App\Location', 'id', 'location_id', 'location_id', 'id'); }

    
}