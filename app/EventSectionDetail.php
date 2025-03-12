<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EventSectionDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'event_section_id', 'title', 'description', 'language'
    ];

    public function getTitleShortAttribute() {
        if($this->title) : if(strlen($this->title) >15) :
            $title_short = substr($this->title, 0, 15).'...'; else:
            $title_short = $this->title; endif; else: $title_short = ''; endif;
        return $title_short;
    }
}
