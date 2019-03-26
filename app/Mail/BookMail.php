<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class BookMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            return $this->view('emails.welcome')->with(['book' => $cart]);
        }
        return $this->view('emails-welcome')->with(['book' => []]);
    }

}
