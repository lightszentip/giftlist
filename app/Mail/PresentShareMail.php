<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PresentShareMail extends Mailable
{
    use Queueable, SerializesModels;

    public $present;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($present)
    {
        //
        $this->present = $present;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject
        (config('app.presentlist_mail_title'))->view('mail')
            ->from((config('app.presentlist_mail_from_email')),config('app.presentlist_mail_from_name'));
    }
}
