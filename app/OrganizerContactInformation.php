<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrganizerContactInformation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];
    protected $primaryKey = 'organizer_id';

    public function organizer() { return $this->belongsTo('App\Organizer'); }
}
