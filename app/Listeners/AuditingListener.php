<?php

namespace App\Listeners;

use OwenIt\Auditing\Events\Auditing;

class AuditingListener
{
    /**
     * Create the Auditing event listener.
     */
    public function __construct()
    {
        // ...
    }

    /**
     * Handle the Auditing event.
     *
     * @param \OwenIt\Auditing\Events\Auditing $event
     * @return void|boolean
     */
    public function handle(Auditing $event)
    {
        if(sizeof($event->model->toAudit()['old_values']) < 1 && sizeof($event->model->toAudit()['new_values']) < 1) {
            return false;
        }
    }
}
