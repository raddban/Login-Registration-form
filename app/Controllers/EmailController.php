<?php

namespace Mail\Controllers;

use Mail\Core\Mail;
use Mail\Core\View;

class EmailController
{

    public function emailPage()
    {
        View::index('sendMail.php');
    }
    public function send()
    {
        Mail::send();
    }
}