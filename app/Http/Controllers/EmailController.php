<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\Email as Email;

class EmailController extends Controller
{
    public $cc;
    public $email;
    public function index($ccemails,$sentto)
    {
        $mail = new Email();

        $mail->subject('Your email subject');

        $data = [
            'mail' => "this is a test email", // Pass the $mail object to the view
        ];
        $this->cc=$ccemails;
        $this->email=$sentto;

        Mail::send('Email.EmailContent', $data, function ($message) use ($mail) {

            $message->to($this->email);
            if($this->cc!=1) {
                $result=explode(",",$this->cc);
                for ($i = 0; $i < count($result); $i++) {
                    $message->cc($result[$i]);  // Add CC recipient
                }
            }
           // Set CC recipient
            $message->subject($mail->subject);
        });


    }

}
