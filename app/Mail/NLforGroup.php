<?php

namespace App\Mail;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NLforGroup extends Mailable
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
        /* von der IE Aussendung
        if($this->user->language_code == 'de') {
            return $this->
            view('emails.NLforIE-de')->
            subject('Sonderregelung für Teilnehmer vom "Immortal Enlightenment 2011"')->
            text('emails.plain.NLforIE-de-plain');
        } else {
            return $this->
            view('emails.NLforIE-en')->
            subject('Special option for participants of "Immortal Enlightenment 2011"')->
            text('emails.plain.NLforIE-en-plain');
        }
        */

        if($this->user->language_code == 'de') {
            return $this->
            view('emails.NLforIE-de')->
            subject('Bitte um Feedback zu unseren Online-Programmen')->
            text('emails.plain.NLforIE-de-plain');
        } else {
            return $this->
            view('emails.NLforIE-en')->
            subject('Request for feedback about our online programs')->
            text('emails.plain.NLforIE-en-plain');
        }
    }
}
