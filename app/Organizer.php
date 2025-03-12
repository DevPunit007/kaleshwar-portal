<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Organizer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'organizer_name', 'type', 'organizer_email', 'organizer_website', 'token', 'status', 'is_visible'
    ];

    protected $appends = [
        'topic_ids'
    ];

    protected $with = [
        'admin'
    ];

    public function relations() { return $this->hasMany('App\UserOrganizerRelation'); }
    public function users() { return $this->hasManyThrough(
        'App\User',
        'App\UserOrganizerRelation',
        'organizer_id',     // ID an Vermittler um mit hiesigem Model (Ursprung) zu verbinden
        'id',                       // ID am Ziel das mit Vermittler verbindet
        'id',                       // ID am Ursprung um mit Vermittler zu verbinden.
        'user_id'       // ID an Vermittler um mit Ziel zu verbinden.
    ); }
    public function admin() { return $this->hasOneThrough(
        'App\User',
        'App\UserOrganizerRelation',
        'organizer_id',     // ID an Vermittler um mit hiesigem Model (Ursprung) zu verbinden
        'id',                       // ID am Ziel das mit Vermittler verbindet
        'id',                       // ID am Ursprung um mit Vermittler zu verbinden.
        'user_id'
    ); }

    public function organizerDetails() { return $this->hasMany('App\OrganizerDetail');}
    public function organizerDetail(){ return $this->hasOne('App\OrganizerDetail', 'organizer_id', 'id')->where('language', app()->getLocale()); }
    public function organizerDetailDefault(){ return $this->hasOne('App\OrganizerDetail', 'organizer_id', 'id')->where('language', 'en'); }
    public function getOrganizerDetailLanguageAttribute()
    {
        return $this->organizerDetail ? $this->organizerDetail : $this->organizerDetailDefault;
    }
    public function organizerContactInformation() {return $this->hasOne('App\OrganizerContactInformation');}
    public function organizerPhoneNumbers() {return $this->hasMany('App\OrganizerPhoneNumber');}
    public function all_topics() {return $this->hasManyThrough('App\Topic', 'App\OrganizerTopicRelation', 'organizer_id', 'id', 'id', 'topic_id');}
    public function topics() {return $this->hasManyThrough('App\Topic', 'App\OrganizerTopicRelation', 'organizer_id', 'id', 'id', 'topic_id')->where('certification', 0);}
    public function teachings() {return $this->hasManyThrough('App\Topic', 'App\OrganizerTopicRelation', 'organizer_id', 'id', 'id', 'topic_id')->where('certification', 1);}
    public function certifications() {return $this->hasManyThrough('App\Topic', 'App\OrganizerTopicCertification', 'organizer_id', 'id', 'id', 'topic_id');}
    public function notifications() { return $this->morphMany('App\NotificationLog', 'reference'); }

    public function getTopicIdsAttribute()
    {
        return $this->all_topics->pluck('id')->toArray();
    }
    public function getIsVisibleNameAttribute()
    {
        switch ($this->is_visible) {
            case(0):
                return "No";
                break;
            case(1):
                return "Yes";
                break;
        }
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case(1):
                return "Active";
                break;
            case(2):
                return "Inactive";
                break;
            case(3):
                return "Blocked";
                break;
            case(4):
                return "Internal";
                break;
            default:
                return "Unknown";
                break;
        }
    }

}
