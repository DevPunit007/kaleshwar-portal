<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserChild extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'date_of_birth', 'gender'
    ];

    public function user(){ return $this->hasOne('App\User'); }
}
