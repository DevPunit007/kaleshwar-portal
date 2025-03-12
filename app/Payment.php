<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Payment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'payment_year',
        'payment_date',
        'payment_account_id',
        'user_id',
        'reference_type',
        'reference_id',
        'amount_sent',
        'amount_received',
        'payment_part_id',
        'description'
    ];

    /**
     * @return array
     */
    public function paymentAccount() { return $this->hasOne('App\PaymentAccount', 'id', 'payment_account_id'); }
    public function userInformation() { return $this->hasOne('App\User', 'id', 'project_contact_person_id'); }
    public function contactInformation() { return $this->hasOne('App\UserContactInformation', 'id', 'project_contact_person_id'); }

    public function reference() { return $this->morphTo(); }

    public function getDisplayNameAttribute() { return "{$this->payment_year}"; }

}
