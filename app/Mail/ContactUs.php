<?php

namespace Qwikkar\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The form of contact
     *
     * @var array
     */
    public $form = [];

    /**
     * Create a new message instance.
     *
     * @param $form
     */
    public function __construct($form)
    {
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('mail.contact-us')
            ->from($this->form['email'], $this->form['name'])
            ->subject('ContactUsQwikkar: ' . (isset($this->form['subject']) ? $this->form['subject'] : ''))
            ->to(config('mail.from.address'), config('mail.from.name'));
    }
}
