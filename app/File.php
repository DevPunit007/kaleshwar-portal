<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class File extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'title',
        'type',
        'date_as_string',
        'file_name',
        'file_path',
        'file_extension',
        'reference_type',
        'reference_id',
        'uploader_id'
    ];
    public function reference() { return $this->morphTo(); }
    public function uploader() { return $this->hasOne('App\User', 'id', 'uploader_id'); }
}
