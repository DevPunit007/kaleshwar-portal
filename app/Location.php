<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Location extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'geodata', 'creator_id'
    ];

    public function locationDetail() { return $this->hasOne('App\LocationDetail', 'location_id', 'id'); }
    public function locationDetails() { return $this->hasMany('App\LocationDetail', 'location_id', 'id'); }
    public function buildings() { return $this->hasMany('App\Building', 'location_id', 'id'); }
}
