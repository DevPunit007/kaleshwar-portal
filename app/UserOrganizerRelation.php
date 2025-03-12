<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserOrganizerRelation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id', 'organizer_id', 'role'
    ];

    public function user(){ return $this->hasOne('App\User', 'id', 'user_id'); }
    public function contactInformation(){ return $this->hasOneThrough('App\UserContactInformation', 'App\User' , 'id', 'id', 'user_id', 'id'); }
    public function organizer(){return $this->hasOne('App\Organizer', 'id', 'organizer_id'); }
}
