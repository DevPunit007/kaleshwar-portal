<?php

namespace App\Mail;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserBirthdayMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $user;


    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch($this->user->language_code == 'de') {
            case 'de':
                return $this->
                view('emails.user-birthday-de')->
                subject('Alles Gute zum Geburtstag aus Penukonda')->
                text('emails.plain.user-birthday-de-plain');
            default:
                return $this->
                view('emails.user-birthday-en')->
                subject('Happy birthday message from Penukonda')->
                text('emails.plain.user-birthday-en-plain');
                break;
        }
    }
}
