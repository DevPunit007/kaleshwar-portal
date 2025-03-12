<?php

namespace App\Mail;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingAcceptance extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $booking;
    public $eventDetail;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking, $event, $eventDetail, $user)
    {
        $this->event = $event;
        $this->booking = $booking;
        $this->eventDetail = $eventDetail;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->
        view('emails.booking-acceptance')->
        bcc('thomas@stenzel.pro')->
        subject('Booking acceptance and informations for ' . $this->eventDetail->title)->
        text('emails.plain.booking-acceptance-plain');
    }
}
