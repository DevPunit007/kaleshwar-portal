<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use Notifiable;
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    protected $fillable = [
        'email',
        'password',
        'rule_id',
        'first_name',
        'middle_name',
        'last_name',
        'nickname',
        'language_code',
        'last_login',
        'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relations to other models
     */
    public function userRule() { return $this->hasOne('App\UserRule', 'id', 'rule_id'); }
    public function contactInformation() { return $this->hasOne('App\UserContactInformation', 'id'); }
    public function personalInformation() { return $this->hasOne('App\UserPersonalInformation', 'id'); }
    public function spiritualHistory() { return $this->hasOne('App\UserSpiritualHistory', 'id'); }
    public function ashramData() { return $this->hasOne('App\UserAshramData', 'id'); }
    public function files() { return $this->morphMany('App\File', 'reference'); }
    public function phoneNumbers() { return $this->hasMany('App\UserPhoneNumber'); }
    public function bookings () { return $this->hasMany('App\Booking'); }
    public function groups () { return $this->hasMany('App\UserOrganizerRelation')->whereHas('organizer', function ($query) { $query->where('type', 'group'); }); }
    public function teachers () { return $this->hasMany('App\UserOrganizerRelation')->whereHas('organizer', function ($query) { $query->where('type', 'teacher'); }); }
    public function teacher () { return $this->hasOne('App\UserOrganizerRelation')->where('role', 'admin')->whereHas('organizer', function ($query) { $query->where('type', 'teacher'); }); }

    /**
     * Accessors calculated
     */
    public function getBookingsCountAttribute() { return $this->bookings->count(); }

}
