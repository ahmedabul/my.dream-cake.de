<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class cancelOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$reasonCancel,$adminReaktion) 
    {
        $this->order=$order; $this->reasonCancel=$reasonCancel; $this->adminReaktion=$adminReaktion;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.cancelOrderEmail',['order'=>$this->order, 'reasonCancel'=>$this->reasonCancel, 'adminReaktion'=>$this->adminReaktion]);
    }
}
