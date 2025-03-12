<?php

namespace App\Mail;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NLforTeacher extends Mailable
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
        if($this->user->language_code == 'de') {
            return $this->
            view('emails.NLforTeacher-de')->
            subject('Anleitung zur Einrichtung eines Lehrer-Profils');
        } else {
            return $this->
            view('emails.NLforTeacher-en')->
            subject('Tutorial to setup your teacher profile');
        }
    }
}
