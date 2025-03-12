<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionReport extends Mailable
{
    use Queueable, SerializesModels;

    private $exception;

    /**
     * Create a new message instance.
     */
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.exception-report')
            ->with(['exception' => $this->exception])
            ->subject('Kaleshwar Portal Error Report')
            ->text('emails.plain.exception-report-plain');
    }
}
