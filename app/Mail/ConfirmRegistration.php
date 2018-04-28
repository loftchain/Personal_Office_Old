<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    public function __construct()
    {

    }

    public function build()
    {
	    return $this->from('support@loftchain.io')
		    ->view('mails.registration_confirmation');
    }
}
