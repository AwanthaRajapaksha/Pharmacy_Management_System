<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendStates extends Mailable
{
    use Queueable, SerializesModels;

    public $requestData;


    public function __construct(array  $request)
    {
        $this->requestData = $request;

    }


    public function build()
    {
        return $this->view('email.adminemailbody');
    }
}
