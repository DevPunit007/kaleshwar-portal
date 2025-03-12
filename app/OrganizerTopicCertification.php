<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizerTopicCertification extends Model
{
    protected $guarded = [];

    public function topic() {return $this->hasOne('App\Topic');}

}
