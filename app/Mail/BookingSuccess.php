<?php

namespace App\Mail;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingSuccess extends Mailable
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
        view('emails.booking-success')->
        subject('Booking confirmation and details for ' . $this->eventDetail->title)->
        // attach('/path/to/file', ['as' => 'name.pdf', 'mime' => 'application/pdf'])->
        // attachFromStorage('/path/to/file', 'name.pdf', ['mime' => 'application/pdf'])-> // For files on server disk
        // ->attachData($this->pdf, 'name.pdf', ['mime' => 'application/pdf',])-> // to attach raw data, e.g. generated PDF in memory
        text('emails.plain.booking-success-plain');
    }
}
