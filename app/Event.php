<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use OwenIt\Auditing\Contracts\Auditable;

class Event extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'list_name',
        'event_category_id',
        'location_id',
        'event_contact_person_id',
        'organizer_id',
        'is_visible',
        'has_date',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'use_booking',
        'use_confirmation',
        'picture_link'
    ];

    protected $appends = ['eventDetailLanguage'];

    public function eventCategory() { return $this->hasOne('App\EventCategory', 'id' , 'event_category_id'); }
    public function userInformation() { return $this->hasOne('App\User', 'id', 'event_contact_person_id'); }
    public function contactInformation() { return $this->hasOne('App\UserContactInformation', 'id', 'event_contact_person_id'); }

    public function eventDetails(){ return $this->hasMany('App\EventDetail', 'event_id', 'id'); }
    public function eventDetail(){ return $this->hasOne('App\EventDetail', 'event_id', 'id')->where('language', app()->getLocale()); }
    public function eventDetailDefault(){ return $this->hasOne('App\EventDetail', 'event_id', 'id')->where('language', 'en'); }

    public function organizer(){ return $this->hasOne('App\Organizer', 'id', 'organizer_id'); }
    public function locationDetails(){ return $this->hasOne('App\LocationDetail', 'location_id', 'location_id'); }

    public function eventSections(){ return $this->hasMany('App\EventSection', 'event_id', 'id'); }
    public function eventSectionDetails(){ return $this->hasManyThrough('App\EventSectionDetail', 'App\EventSection', 'event_id', 'event_section_id', 'id', 'id'); }
    public function eventSectionDetail(){ return $this->hasOneThrough('App\EventSectionDetail', 'App\EventSection', 'event_id', 'event_section_id', 'id', 'id')->where('language', app()->getLocale()); }
    public function eventSectionDetailDefault(){ return $this->hasOneThrough('App\EventSectionDetail', 'App\EventSection', 'event_id', 'event_section_id', 'id', 'id')->where('language', 'en'); }

    public function getEventDetailLanguageAttribute()
    {
        return $this->eventDetail ? $this->eventDetail : $this->eventDetailDefault;
    }
    public function getEventSectionDetailLanguageAttribute()
    {
        return $this->eventSectionDetail ? $this->eventSectionDetail : $this->eventSectionDetailDefault;
    }

    public function getDisplayNameAttribute() { return "{$this->eventDetails[0]->title}"; }
}
