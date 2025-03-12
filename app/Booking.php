<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Booking extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'user_id',
        'event_section_id',
        'status',
        'booking_message',
        'notes',
        'event_section_price',
        'currency',
        'payment_id'
    ];

    public function user() { return $this->hasOne('App\User', 'id', 'user_id'); }
    public function eventSection() { return $this->hasOne('App\EventSection', 'id', 'event_section_id'); }
    public function eventSectionDetail(){ return $this->hasOneThrough('App\EventSectionDetail', 'App\EventSection', 'id', 'event_section_id', 'event_section_id', 'id')->where('language', app()->getLocale()); }
    public function eventSectionDetailDefault(){ return $this->hasOneThrough('App\EventSectionDetail', 'App\EventSection', 'id', 'event_section_id', 'event_section_id', 'id')->where('language', 'en'); }

    public function event() { return $this->hasOneThrough('App\Event', 'App\EventSection' , 'id', 'id', 'event_section_id', 'event_id'); }
    public function rooms() { return $this->hasMany('App\Room'); }
    public function bookingDetail() { return $this->hasOne('App\BookingDetail'); }
    public function payments() { return $this->hasMany('App\Payment'); }

    public function comments() { return $this->morphMany('App\Comment', 'reference'); }

    public function getEventSectionDetailLanguageAttribute()
    {
        return $this->eventSectionDetail ? $this->eventSectionDetail : $this->eventSectionDetailDefault;
    }
    public function getEventIdAttribute() { return $this->event->id; }
    public function getEventStartDateAttribute() { return $this->event->start_date; }
    public function getBookingStatusNameAttribute() {
        switch($this->status) {
            case 1:
                return 'Registered';
                break;
            case 2:
                return 'Accepted';
                break;
            case 3:
                return 'Canceled';
                break;
            case 4:
                return 'Wait';
                break;
            case 5:
                return 'Paid';
                break;
            case 6:
                return 'Free';
                break;
            default:
                return 'Unknown';
                break;
        }
    }
    public function getBookingStatusColorAttribute() {
        switch($this->status) {
            case 1:
                return 'bg-secondary';
                break;
            case 2:
                return 'bg-info';
                break;
            case 3:
                return 'bg-danger';
                break;
            case 4:
                return 'bg-warning';
                break;
            case 5:
                return 'bg-success';
                break;
            case 6:
                return 'bg-success';
                break;
            default:
                return 'bg-light';
                break;
        }
    }

}
