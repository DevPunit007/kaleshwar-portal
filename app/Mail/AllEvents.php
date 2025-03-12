<?php

namespace App\Mail;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AllEvents extends Mailable
{
    use Queueable, SerializesModels;

    public $events;


    public function __construct($events)
    {
        $this->events = $events;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 'with()' doesn't have to be used because public variables are automatically passed to views
        return $this->
        view('emails.all-events')->
        subject('Ashram Newsletter')->          //Betreff eingefügt (TS)
        // attach('/path/to/file', ['as' => 'name.pdf', 'mime' => 'application/pdf'])->
        // attachFromStorage('/path/to/file', 'name.pdf', ['mime' => 'application/pdf'])-> // For files on server disk
        // ->attachData($this->pdf, 'name.pdf', ['mime' => 'application/pdf',])-> // to attach raw data, e.g. generated PDF in memory
        text('emails.all-events-plain');
    }
}
