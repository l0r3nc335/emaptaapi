<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The data instance.
     *
     * @var Data
     */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->data->template)
            ->subject($this->data->subject)
            ->with(['data' => $this->data]);
    }
}
