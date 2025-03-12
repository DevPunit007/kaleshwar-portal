<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EventSection extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id', 'event_id', 'room_id', 'section_tutor_id', 'has_own_date', 'start_date', 'end_date', 'start_time', 'end_time', 'has_registration', 'is_visible', 'is_topic', 'is_bookable', 'is_discounted', 'price_usd', 'price_euro'
    ];

    public function event(){ return $this->belongsTo('App\Event'); }
    public function eventSectionDetails(){ return $this->hasMany('App\EventSectionDetail', 'event_section_id', 'id'); }
    public function eventSectionDetail(){ return $this->hasOne('App\EventSectionDetail', 'event_section_id', 'id')->where('language', app()->getLocale()); }
    public function eventSectionDetailDefault(){ return $this->hasOne('App\EventSectionDetail', 'event_section_id', 'id')->where('language', 'en'); }

    public function getEventSectionDetailLanguageAttribute()
    {
        return $this->eventSectionDetail ? $this->eventSectionDetail : $this->eventSectionDetailDefault;
    }
}
