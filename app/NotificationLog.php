<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class NotificationLog extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'reference_type',
        'reference_id',
        'reason',
        'result'
    ];
    public function reference() { return $this->morphTo(); }
}
