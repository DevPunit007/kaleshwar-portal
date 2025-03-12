<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class NewsletterSubscription extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id', 'source', 'newsletter_name', 'newsletter_confirmed'
    ];

    public function user() { return $this->hasOne('App\User'); }
}
