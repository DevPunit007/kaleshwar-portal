<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use OwenIt\Auditing\Contracts\Auditable;

class Project extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'list_name',
        'organizer_id',
        'project_contact_person_id',
        'location_id',
        'is_visible'
    ];

    //protected $appends = ['projectDetailLanguage'];

    public function userInformation() { return $this->hasOne('App\User', 'id', 'project_contact_person_id'); }
    public function contactInformation() { return $this->hasOne('App\UserContactInformation', 'id', 'project_contact_person_id'); }

    public function organizer(){ return $this->hasOne('App\Organizer', 'id', 'organizer_id'); }
    public function locationDetails(){ return $this->hasOne('App\LocationDetail', 'location_id', 'location_id'); }

    public function getDisplayNameAttribute() { return "{$this->list_name}"; }  // todo Anpassen wenn poject_details erstellt wurde
}
