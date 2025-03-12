<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingPaymentConfirmation extends Mailable
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
        view('emails.booking-payment-confirmation')->
        subject('Payment receipt for ' . $this->eventDetail->title)->
        text('emails.plain.booking-payment-confirmation-plain');
    }
}
